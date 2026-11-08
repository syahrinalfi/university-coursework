#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
    int b = 00;
    printf("%d", b);
    int a = 1;
    for (int i = 0; i < 5; i++)
    {
        for (int j = 0; j < 10; j++)
        {
            if (j == 5)
                printf("      ");
            if (a < 10)
                printf(" %d  ", a);
            else
                printf("%d  ", a);
            a++;
        }
        printf("\n\n");
    }
    printf("\n=============== Layar Bioskop ===============");
    
    return 0;
}
