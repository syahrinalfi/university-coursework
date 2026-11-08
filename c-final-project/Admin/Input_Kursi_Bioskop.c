#include <stdio.h>
#include <stdlib.h>
#include <string.h>

FILE *fp;

struct Kursi
{
    char hari[10], film[50];
    char nomor[50][5];
} Kursi, arrKursi[6];

int main()
{
    int a;
    fp = fopen("File/Kursi.txt", "w");
    for (int i = 0; i < 6; i++)
    {
        a = 1;
        printf("Hari : ");
        scanf("%[^\n]", &Kursi.hari);
        fflush(stdin);
        printf("Film : ");
        scanf("%[^\n]", &Kursi.film);
        fflush(stdin);
        for (int j = 0; j < 50; j++)
        {
            sprintf(Kursi.nomor[j], "%d ", a);
            fflush(stdin);
            a++;
        }
        fflush(stdin);
        fwrite(&Kursi, sizeof(Kursi), 1, fp);
    }
    fclose(fp);
    /* fp = fopen("File/Kursi.txt", "r");
    for (int i = 0; i < 1; i++)
    {
        fread(&arrKursi[i], sizeof(arrKursi[i]), 1, fp);
        for (int j = 0; j < 50; j++)
        {
            printf("%d \n", arrKursi[i].nomor[j]);
        }
    }
    fclose(fp); */
    
    return 0;
}
