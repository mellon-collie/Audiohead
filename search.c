#include "definition.h"
#include <stdio.h>
#include <stdlib.h>
#include <dirent.h>
#include <string.h>


int getHashValueSongs(struct song1 HashSongs[],char *name)
{
	int n = strlen(name);
	int sum = 0;
	int i = 0;
	while(name[i]!='\0')
	{
		sum = sum + name[i];
		i++;
	}
	int hashvalue = sum%150;
	if(HashSongs[hashvalue].occupied!=0)
	{
		int j = hashvalue;
		int k = 1;
		while(HashSongs[j].occupied!=0)
		{
			j = (hashvalue + k*k)%150;
			k++;
		}
		return j;
	}
	return hashvalue;
}

int getHashValueAlbums(struct album HashAlbums[],char *name)
{
	int n = strlen(name);
	int sum = 0;
	int i = 0;
	while(name[i]!='\0')
	{
		sum = sum + name[i];
		i++;
	}
	int hashvalue = sum%150;
	if(HashAlbums[hashvalue].occupied!=0)
	{
		int j = hashvalue;
		int k = 1;
		while(HashAlbums[j].occupied!=0)
		{
			j = (hashvalue + k*k)%150;
			k++;
		}
		return j;
	}
	return hashvalue;
}

int getHashValueArtists(struct artist HashArtists[],char *name)
{
	int n = strlen(name);
	int sum = 0;
	int i = 0;
	while(name[i]!='\0')
	{
		sum = sum + name[i];
		i++;
	}
	int hashvalue = sum%150;
	if(HashArtists[hashvalue].occupied!=0)
	{
		int j = hashvalue;
		int k = 1;
		while(HashArtists[j].occupied!=0)
		{
			j = (hashvalue + k*k)%150;
			k++;
		}
		return j;
	}
	return hashvalue;
}

int getHashVal(char *name)
{
	int n = strlen(name);
	int sum = 0;
	int i = 0;
	while(name[i]!='\0')
	{
		sum = sum + name[i];
		i++;
	}
	return sum%150;
}

int checkIfAlbumExists(struct album HashAlbums[],char *album)
{
	for(int i = 0;i<150;i++)
	{
		if(strcmp(HashAlbums[i].albumName,album) == 0)
		{
			return i;
		}
	}
	return -1;
}

int checkIfArtistExists(struct artist HashArtists[],char *artist)
{
	for(int i = 0;i<150;i++)
	{
		if(strcmp(HashArtists[i].artistName,artist) == 0)
		{
			return i;
		}
	}
	return -1;
}

void loadMusicFile(struct song1 HashSongs[],struct album HashAlbums[],struct artist HashArtists[])
{
	for(int i = 0;i<150;i++)
	{
		HashSongs[i].occupied = 0;
		HashAlbums[i].occupied = 0;
		HashArtists[i].occupied = 0;
	}
	FILE *fp;
	fp = fopen("allsongs.txt","r");
	char line[256];
	while(fgets(line,sizeof(line),fp))
	{
		char song[50];
		char album[50];
		char artist[50];
		strcpy(song,strtok(line,";"));
		strcpy(album,strtok(NULL,";"));
		strcpy(artist,strtok(NULL,";"));
		int songHash = getHashValueSongs(HashSongs,song);
		strcpy(HashSongs[songHash].songName,song);
		strcpy(HashSongs[songHash].albumName,album);
		strcpy(HashSongs[songHash].artistName,artist);
		
		HashSongs[songHash].occupied = 1;
		int checkAlbum = checkIfAlbumExists(HashAlbums,album);
		if(checkAlbum == -1)
		{
			int albumHash = getHashValueAlbums(HashAlbums,album);
			strcpy(HashAlbums[albumHash].albumName,album);
			strcpy(HashAlbums[albumHash].artistName,artist);
			HashAlbums[albumHash].number_of_songs = 0;
			HashAlbums[albumHash].songs[HashAlbums[albumHash].number_of_songs] = songHash;
			HashAlbums[albumHash].occupied = 1;
		}
		else
		{
			HashAlbums[checkAlbum].number_of_songs++;
			HashAlbums[checkAlbum].songs[HashAlbums[checkAlbum].number_of_songs] = songHash;
		}

		int checkArtist = checkIfArtistExists(HashArtists,artist);
		if(checkArtist == -1)
		{
			int artistHash = getHashValueArtists(HashArtists,artist);
			strcpy(HashArtists[artistHash].artistName,artist);
			HashArtists[artistHash].number_of_songs = 0;
			HashArtists[artistHash].songs[HashArtists[artistHash].number_of_songs] = songHash;
			HashArtists[artistHash].occupied = 1;
		}
		else
		{
			HashArtists[checkArtist].number_of_songs++;
			HashArtists[checkArtist].songs[HashArtists[checkArtist].number_of_songs] = songHash;
		}

		
		
	}
}

int searchSong(struct song1 HashSongs[],char *songName,char *albumName,char *artistName)
{
	int n = getHashVal(songName);
	if(strcmp(HashSongs[n].songName,songName) == 0)
	{
		strcpy(albumName,HashSongs[n].albumName);
		strcpy(artistName,HashSongs[n].artistName);
		return 1;
	}
	int j = n;
	int i = 1;
	for(int k = 0;k<150;k++)
	{
		j = (j + i*i)%150;
		if(strcmp(HashSongs[j].songName,songName) == 0)
		{
			strcpy(albumName,HashSongs[n].albumName);
			strcpy(artistName,HashSongs[n].artistName);
			return 1;
		}
		i++;
	}
	return 0;
}



void searchAlbum(struct album HashAlbums[],struct song1 HashSongs[],char *albumName)
{
	int n = getHashVal(albumName);
	if(strcmp(HashAlbums[n].albumName,albumName) == 0)
	{
		puts(HashAlbums[n].artistName);
		puts(albumName);
		for(int i = 0;i<=HashAlbums[n].number_of_songs;i++)
		{
			puts(HashSongs[HashAlbums[n].songs[i]].songName);
		}
		return;
	}
	int j = n;
	int i = 1;
	for(int k = 0;k<150;k++)
	{
		j = (j+i*i)%150;
		if(strcmp(HashAlbums[j].albumName,albumName) == 0)
		{
			puts(HashAlbums[j].artistName);
			puts(albumName);
			for(int l = 0;l<=HashAlbums[j].number_of_songs;l++)
			{
				puts(HashSongs[HashAlbums[j].songs[l]].songName);
			}
			return;
		}
		
	}
	puts("Album Not Found");
}

void searchArtist(struct artist HashArtists[],struct song1 HashSongs[],char *artistName)
{
	int n = getHashVal(artistName);
	if(strcmp(HashArtists[n].artistName,artistName) == 0)
	{
		puts(HashArtists[n].artistName);
		for(int i = 0;i<=HashArtists[n].number_of_songs;i++)
		{
			puts(HashSongs[HashArtists[n].songs[i]].songName);
		}
		return;
	}
	int j = n;
	int i = 1;
	for(int k = 0;k<150;k++)
	{
		j = (j+i*i)%150;
		if(strcmp(HashArtists[j].artistName,artistName) == 0)
		{
			puts(HashArtists[j].artistName);
			for(int l = 0;l<=HashArtists[j].number_of_songs;l++)
			{
				puts(HashSongs[HashArtists[j].songs[l]].songName);
			}
			return;
		}
		
	}
	puts("Artist Not Found");
}


int main(int argc,char *argv[])
{
	struct song1 songs[150];
   	struct artist artists[150];
    struct album albums[150];
    loadMusicFile(songs,albums,artists);
    if(strcmp(argv[1],"songs") == 0)
    {
    	char songName[200];
		char albumName[200];
		char artistName[200];
		strcpy(songName,argv[2]);
		for(int i = 2;i<argc-1;i++)
		{
			strcat(songName," ");
			strcat(songName,argv[i+1]);
		}
		int a = searchSong(songs,songName,albumName,artistName);
		if(a == 1)
		{
			puts(songName);
			puts(albumName);
			puts(artistName);
		}
		else
		{
			puts("Song Not Found");
		}
	}
	else if(strcmp(argv[1],"albums") == 0)
	{
    	 char albumName[200];
    	 strcpy(albumName,argv[2]);
    	 for(int i = 2;i<argc-1;i++)
		 {
			strcat(albumName," ");
			strcat(albumName,argv[i+1]);
		 }
		 char artist[50];
		 searchAlbum(albums,songs,albumName);

	}
	else if(strcmp(argv[1],"artists") == 0)
	{
		char artistName[50];
		strcpy(artistName,argv[2]);
		for(int i = 2;i<argc-1;i++)
		{
			strcat(artistName," ");
			strcat(artistName,argv[i+1]);
	    }
		searchArtist(artists,songs,artistName);
	}
}