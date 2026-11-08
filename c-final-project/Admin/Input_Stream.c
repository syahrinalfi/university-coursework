#include <stdio.h>
#include <stdlib.h>

FILE *fp;

struct Stream
{
    char film[50], status[50], genre[10];
} Stream, arrStream[6], temp;

int main()
{
    fp = fopen("File/Film Stream.txt", "w");
    for (int i = 0; i < 6; i++)
    {
        printf("Nama Film : ");
        scanf("%[^\n]s", &Stream.film);
        fflush(stdin);
        printf("Genre \t: ");
        scanf("%[^\n]s", &Stream.genre);
        fflush(stdin);
        printf("Status \t: ");
        scanf("%[^\n]s", &Stream.status);
        fflush(stdin);
        fwrite(&Stream, sizeof(Stream), 1, fp);
    }
    fclose(fp);
    
    return 0;
}
