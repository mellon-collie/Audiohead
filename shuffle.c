#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>
struct shuffleSong
{
	char artistName[100];
	char albumName[100];
	char songName[100];
	int n;
};
int main()
{
	
	//printf("Hello!!\n");
	struct shuffleSong s[100];
	FILE *fp;
	fp = fopen("songsList.txt","r");
	//printf("file opened!!\n");
	int j = 0;
	char line[250];
	while(fgets(line,sizeof(line),fp))
	{
		strcpy(s[j].songName,strtok(line,";"));
		strcpy(s[j].albumName,strtok(NULL,";"));
		strcpy(s[j].artistName,strtok(NULL,";"));
		s[j].n = atoi(strtok(NULL,";"));
		j++;
	}
	srand(time(NULL));
	int a[100];
	for(int i = 0;i<j;i++)
	{
		a[i] = i+1;
		//printf("%d ",a[i]);

	}
	printf("\n");
	int l = 99;
	while(l>=0)
	{
		int r = rand();
		int r1 = r%(l+1);
		char output[300];
		strcpy(output,s[a[r1]].songName);
		strcat(output,";");
		strcat(output,s[a[r1]].albumName);
		strcat(output,";");
		strcat(output,s[a[r1]].artistName);
		strcat(output,";");
		puts(output);
		a[r1] = a[l];
		l = l-1;
	}
}
