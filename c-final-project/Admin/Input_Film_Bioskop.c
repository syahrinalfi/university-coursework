#include <stdio.h>
#include <stdlib.h>
#include <string.h>

struct Film
{
    char film[50];
} Film, arrFilm[3];

FILE *fp;

int main()
{
    fp = fopen("File/Film Bioskop.txt", "w");
    for (int i = 0; i < 3; i++)
    {
        printf("Film : ");
        scanf("%[^\n]", &Film.film);
        fflush(stdin);
        fwrite(&Film, sizeof(Film), 1, fp);
    }
    fclose(fp);

    fp = fopen("File/Film Bioskop.txt", "r");
    for (int i = 0; i < 3; i++)
    {
        fread(&arrFilm[i], sizeof(arrFilm[i]), 1, fp);
        printf("%s\n", arrFilm[i].film);
    }
    fclose(fp);
    
    return 0;
}
