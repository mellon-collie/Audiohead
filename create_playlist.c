#include "definition.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>


void insertEnd(struct feature **head, const char* song,const char* albumName,const char* artistName) // Insert Song in the End
{
    if ((*head)->ptr == NULL)
    {
        struct song *newnode = (struct song *)malloc(sizeof(struct song));
        newnode->songName = (char *)malloc(sizeof(strlen(song))+1);
        newnode->albumName = (char *)malloc(sizeof(strlen(albumName))+1);
        newnode->artistName = (char *)malloc(sizeof(strlen(artistName))+1);
        strcpy(newnode->songName,song);
        strcpy(newnode->albumName,albumName);
        strcpy(newnode->artistName,artistName);
        newnode->next = newnode->prev = NULL;
        (*head)->ptr = newnode;
        printf("insertEnd = \n");
        puts(newnode->songName);
        return;
    }
    struct song *start = (*head)->ptr;
    struct song *newnode = (struct song *)malloc(sizeof(struct song));
    newnode->songName = (char *)malloc(sizeof(strlen(song))+1);
    newnode->albumName = (char *)malloc(sizeof(strlen(albumName))+1);
    newnode->artistName = (char *)malloc(sizeof(strlen(artistName))+1);
    strcpy(newnode->songName,song);
    strcpy(newnode->albumName,albumName);
    strcpy(newnode->artistName,artistName);
    struct song *temp = (*head)->ptr;
    while(temp->next!=NULL)
    {
        temp = temp->next;
    }
    temp->next = newnode;
    
    newnode->prev = temp;
    newnode->next = NULL;
    printf("insertEnd = \n");
    puts(newnode->songName);
}

void insertBegin(struct feature **head, const char* song,const char* albumName,const char* artistName) // Insert Song in the Beginning
{
    struct song *newnode = (struct song *)malloc(sizeof(struct song));
    newnode->songName = (char *)malloc(sizeof(strlen(song)+1));
    newnode->albumName = (char *)malloc(sizeof(strlen(albumName))+1);
    newnode->artistName = (char *)malloc(sizeof(strlen(artistName))+1);
    strcpy(newnode->songName,song);
    strcpy(newnode->albumName,albumName);
    strcpy(newnode->artistName,artistName);
    newnode->next = NULL;
    newnode->prev = NULL;
    struct song *start = (*head)->ptr;
    if (start == NULL)
    {
        (*head)->ptr = newnode;
        newnode->next = start;
        newnode->prev = NULL;
        printf("insertBegin = \n");
        puts(newnode->songName);
        return;
    }
    newnode->next = start;
    start = newnode;
    printf("insertBegin = hi\n");
    puts(newnode->songName);
}

int main()
{
	FILE *fp;
	fp = fopen("tempPlaylist.txt","r");
	char line[256];
    fgets(line,sizeof(line),fp);
    char plName[100];
    strcpy(plName,strtok(line,":"));
	struct feature *head = (struct feature *)malloc(sizeof(struct feature));
	head->ptr = NULL;
	while(fgets(line,sizeof(line),fp))
	{
		char songName[60];
        char albumName[60];
        char artistName[60];
		char command[2];
        strcpy(songName,strtok(line,";"));
        strcpy(albumName,strtok(NULL,";"));
        strcpy(artistName,strtok(NULL,";"));
		strcpy(command,strtok(NULL,";"));
		if(strcmp(command,"a") == 0)
		{
            printf("a\n");
            puts(songName);
			insertEnd(&head,songName,albumName,artistName);
		}
		else if(strcmp(command,"b") == 0)
		{
            printf("b\n");
            puts(songName);
			insertBegin(&head,songName,albumName,artistName);
		}
	}

	FILE *fp1 = fopen("playlist1.txt","w+");
	struct song *temp = head->ptr;
    while (temp!=NULL)
    {
        printf("%s\n",temp->songName);
        temp = temp->next;
    }
    fclose(fp1);
}

