struct song
{
	char *songName;
    char *albumName;
    char *artistName;
	struct song *next;
	struct song *prev;
};

struct feature
{
	struct song *ptr;
};
struct albumFeature
{
    struct album1 *ptr;
};
struct album1
{
    char *albumName;
    struct album1 *next;
    struct album1 *prev;
};
struct song1
{
	int len;
	char songName[100];
	char albumName[100];
	char artistName[100];
    int occupied;
};

struct album
{
    char albumName[100];
    char artistName[100];
    int songs[50];
    int occupied;
    int number_of_songs;
};

struct artist
{
    char artistName[100];
    int songs[200];
    int number_of_songs;
    int occupied;
};
