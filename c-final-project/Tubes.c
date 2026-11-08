#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <windows.h>

FILE *fp, *fj, *ft;

struct Akun
{
    char nama[50], username[20], password[50], movie[3][40]; // Two-dimensional array
    int balance;
} Acc, arrAcc[999]; // Array of Structure

struct Kursi
{
    char hari[10], film[50];
    char nomor[50][5]; // Two-dimensional array
} Kursi, arrKursi[6];  // Array of Structure

struct Film
{
    char film[50];
} Film, arrFilm[3]; // Array of Structure

struct Stream
{
    char film[50], status[50], genre[10];
} Stream, arrStream[6], temp; // Array of Structure

void Tickandstream()
{
    printf("===================================================");
    printf("\n================== <Tick&Stream> ==================");
    printf("\n===================================================");
}

void baca_data()
{
    char null[5];
    int i = 0;

    fp = fopen("File/Data Akun.txt", "r");              // Membuka File
    while (fread(&arrAcc[i], sizeof(arrAcc[i]), 1, fp)) // Perulangan dan Memasukkan data dari file ke array struct
    {
        if (strcmp(arrAcc[i].nama, null) == 0)
            break; // Loop Control
        i++;
    }
    fclose(fp);                        // Menutup File
    fj = fopen("File/Kursi.txt", "r"); // Membuka File
    for (int i = 0; i < 6; i++)        // Perulangan
    {
        fread(&arrKursi[i], sizeof(arrKursi[i]), 1, fj); // Memasukkan data dari file ke array struct
    }
    fclose(fj);                               // Menutup File
    ft = fopen("File/Film Bioskop.txt", "r"); // Membuka File
    for (int i = 0; i < 3; i++)               // Perulangan
    {
        fread(&arrFilm[i], sizeof(arrFilm[i]), 1, ft); // Memasukkan data dari file ke array struct
    }
    fclose(ft);                              // Menutup File
    fp = fopen("File/Film Stream.txt", "r"); // Membuka file
    for (int i = 0; i < 6; i++)
    {
        fread(&arrStream[i], sizeof(arrStream[i]), 1, fp); // Memasukkan data dari file ke array struct
    }
    fclose(fp); // Menutup File
}

void update_kursi()
{
    fp = fopen("File/Kursi.txt", "w"); // Membuka File
    int n = sizeof(arrKursi) / sizeof(*arrKursi);
    for (int i = 0; i < n; i++) // Perulangan
    {
        fwrite(&arrKursi[i], sizeof(arrKursi[i]), 1, fp); // Memasukkan data ke dalam file
    }
    fclose(fp); // Menutup File
}

void update_akun()
{
    fp = fopen("File/Data Akun.txt", "w"); // Membuka file
    char null[5];
    int i = 0;
    while (strcmp(arrAcc[i].nama, null) != 0) // Perulangan
    {
        fwrite(&arrAcc[i], sizeof(arrAcc[i]), 1, fp); // Memasukkan data ke dalam file
        i++;                                          // Incremental expression
    }
    fclose(fp); // Menutup file
}

//================================= <Login dan Register> ================================
void login(int *idx_acc)
{
    int log, attempt;
    char user_log[30], pass_log[30];

after_regist:        // Label
    Tickandstream(); // Pemanggilan Prosedur
    printf("\n1. Sign In");
    printf("\n2. Sign Up");
pilih: // Label
    printf("\nPilihan : ");
    scanf("%d", &log);
    fflush(stdin);
    system("cls");
    do // Perulangan
    {
        baca_data(); // Pemanggilan Prosedur
        int n = sizeof(arrAcc) / sizeof(*arrAcc);
        int try;
        attempt = 0;
        switch (log) // Percabangan
        {
        case 1:
            printf("========= <Sign In> =========\n");
            printf("Username : ");
            scanf("%[^\n]", &user_log);
            fflush(stdin);
            printf("Password : ");
            scanf("%[^\n]", &pass_log);
            fflush(stdin);
            for (int i = 0; i < n; i++) // Perulangan untuk melakukan searching
            {
                if (strcmp(user_log, arrAcc[i].username) == 0 && strcmp(pass_log, arrAcc[i].password) == 0) // Percabangan dan Pengolah String
                {
                    system("cls");
                    printf("========= <Login Berhasil> =========\n");
                    Sleep(2000);
                    system("cls");
                    *idx_acc = i;
                    break; // Loop control
                }
                else if (strcmp(user_log, arrAcc[i].username) == 0 || strcmp(pass_log, arrAcc[i].password) == 0)
                {
                    system("cls");
                    printf("Username / Password salah\n");
                    Sleep(2000);
                    system("cls");
                    log = 1;
                    attempt = 1;
                    break; // Loop control
                }
                else if (i == n - 1)
                {
                    system("cls");
                    printf("Akun Tidak Terdaftar, Silahkan Melakukan Sign Up\n");
                    Sleep(2000);
                    system("cls");
                    goto after_regist;
                    break; // Loop control
                }
            }
            break;
        case 2:
            fp = fopen("File/Data Akun.txt", "a"); // Membuka File
            printf("========= <Sign Up> =========\n");
            printf("Masukkan Nama \t: ");
            scanf("%[^\n]", &Acc.nama);
            fflush(stdin);
            do // loop
            {
                try = 0;
                printf("Masukkan Username : ");
                scanf("%[^\n]", &Acc.username);
                fflush(stdin);
                for (int i = 0; i < n; i++) // Loop
                {
                    if (strcmp(Acc.username, arrAcc[i].username) == 0) // Operasi String
                    {
                        printf("Username sudah terdaftar, silahkan gunakan username yang lain\n");
                        try = 1;
                    }
                }
            } while (try == 1);
            printf("Masukkan Password : ");
            scanf("%[^\n]", &Acc.password);
            fflush(stdin);
            Acc.balance = 0;
            fwrite(&Acc, sizeof(Acc), 1, fp);
            system("cls");
            printf("========= <Registrasi Berhasil> =========\n");
            Sleep(2000);
            system("cls");
            fclose(fp);
            goto after_regist; // goto statement
            break;
        default:
            printf("\nPilihan tidak tersedia");
            goto pilih; // goto statement
            break;
        }
    } while (attempt == 1);
}

//================================= <Halaman Utama Aplikasi> ================================
void halaman_utama(int *opsi)
{
    printf("========== <SELAMAT DATANG> ==========");
    printf("\nTentukan Pilihan");
    printf("\n1. Streaming");
    printf("\n2. Booking Tiket");
    printf("\n3. Informasi Akun");
    printf("\n4. Log Out");
    printf("\n5. Keluar");
pilih_ulang: // Label
    printf("\nMasukkan Pilihan : ");
    scanf("%d", &*opsi);
    fflush(stdin);
    if (*opsi > 5 || *opsi < 1)
    {
        printf("Pilihan tidak tersedia\n");
        goto pilih_ulang; // goto statement
    }
}

void info_akun(int idx, int *balik)
{
    char null[5];
    int opsi, balance;
kembali: // Label
    printf("===== Data Akun =====");
    printf("\nNama \t: %s", arrAcc[idx].nama);
    printf("\nBalance : %d", arrAcc[idx].balance);
    printf("\nKoleksi : ");
    for (int i = 0; i < 3; i++) // Perulangan
    {
        if (strcmp(arrAcc[idx].movie[0], null) == 0) // Percabangan dan operasi string
        {
            printf("Tidak ada\n");
            break; // loop control
        }
        else if (strcmp(arrAcc[idx].movie[i], null) == 0)
            break; // loop control
        else
            printf("\n%d. %s", i + 1, arrAcc[idx].movie[i]);
    }

    do // Perulangan
    {
        printf("\n\nKetik 2 untuk isi saldo atau ketik 1 untuk kembali : ");
        fflush(stdin);
        scanf("%d", &opsi);
        fflush(stdin);
    } while (opsi != 1 && opsi != 2);

    if (opsi == 1) // Percabangan
    {
        system("cls");
        *balik = opsi;
    }
    else
    {
        printf("\nMasukkan nominal saldo yang ingin diisi : ");
        scanf("%d", &balance);
        arrAcc[idx].balance += balance;
        update_akun(); // Pemanggilan prosedur
        system("cls");
        printf("Pengisian saldo berhasil!\n");
        Sleep(2000);
        system("cls");
        goto kembali; // goto statement
    }
}

void tampilan_kursi(int idx)
{
    int a = 0;
    for (int i = 0; i < 5; i++) // Nested loop
    {
        for (int j = 0; j < 10; j++)
        {
            if (j == 5)
                printf("      ");
            if (a < 10) // Percabangan
                printf(" %s  ", arrKursi[idx].nomor[a]);
            else
                printf("%s  ", arrKursi[idx].nomor[a]);
            a++; // incremental expression
        }
        printf("\n\n");
    }
    printf("\n==================== Layar Bioskop ====================\n\n");
}

void kode(char nama_film[], char hari[], char kursi[], char *hasil_kode)
{
    char booking[5];
    booking[0] = nama_film[0];
    booking[1] = hari[0];
    booking[2] = kursi[0];
    strcpy(hasil_kode, booking); // Operasi string
}

void booking(int idx, int *balik)
{
    int n = sizeof(arrKursi) / sizeof(*arrKursi);
    int a = sizeof(arrFilm) / sizeof(*arrFilm);
    int opsi, indeks_kursi;
    int banyak_kursi, ulang;
    int nomor, opsi_hari;
    char hari[10], data_kursi[50][5], null[5], kode_booking[5];

pilih_film: // Label
    printf("=============== Booking Tiket ===============\n");
    printf("Daftar Film : \n");

    for (int i = 0; i < a; i++) // Perulangan
        printf("%d. %s\n", i + 1, arrFilm[i].film);

    do // Perulangan
    {
        printf("Pilih film yang ingin dibooking (Ketik 4 untuk kembali): ");
        fflush(stdin);
        scanf("%d", &opsi);
        fflush(stdin);
    } while (opsi < 1 && opsi > 4);

kembali:
    if (opsi == 4) // Percabangan
    {
        system("cls");
        *balik = 1;
    }
    else
    {
        *balik = 0;
        system("cls");
        printf("Film : %s", arrFilm[opsi - 1].film);
        printf("\nSilahkan pilih hari : ");
        printf("\n1. Senin \n2. Selasa \n3. Kembali");

        do // loop
        {
            printf("\n= ");
            fflush(stdin);
            scanf("%d", &opsi_hari);
            fflush(stdin);
        } while (opsi_hari > 3 || opsi_hari < 1);

        if (opsi_hari == 1)        // percabangan
            strcpy(hari, "Senin"); // operasi string
        else if (opsi_hari == 2)
            strcpy(hari, "Selasa"); // operasi string
        else if (opsi_hari == 3)
        {
            system("cls");
            goto pilih_film; // goto statement
        }

        for (int i = 0; i < n; i++)                                                                           // loop
            if (strcmp(arrFilm[opsi - 1].film, arrKursi[i].film) == 0 && strcmp(hari, arrKursi[i].hari) == 0) // operasi string
                indeks_kursi = i;

        system("cls");
        tampilan_kursi(indeks_kursi); // pemanggilan prosedur

        printf("\nBerapa banyak kursi yang ingin Anda booking? ");
        fflush(stdin);
        scanf("%d", &banyak_kursi);
        fflush(stdin);
        if (banyak_kursi * 35000 > arrAcc[idx].balance)
        {
            system("cls");
            printf("\nSilahkan melakukan top up terlebih dahulu dalam menu informasi akun");
            Sleep(2000);
            system("cls");
            opsi = 4;
            goto kembali; // goto statement
        }
        arrAcc[idx].balance = arrAcc[idx].balance - (banyak_kursi * 35000);
        update_akun(); // pemanggilan prosedur

        int i = 0;
        do // loop
        {
            ulang = 1;
            printf("Silahkan pilih kursi yang Anda inginkan : ");
            scanf("%d", &nomor);

            if (strcmp(arrKursi[indeks_kursi].nomor[nomor - 1], " X ") == 0 || strcmp(arrKursi[indeks_kursi].nomor[nomor - 1], "X ") == 0) // percabangan dan oeprasi string
            {
                printf("Kursi sudah dibooking, silahkan pilih yang lain\n");
            }
            else
            {
                strcpy(data_kursi[i], arrKursi[indeks_kursi].nomor[nomor - 1]); // operasi string
                if (nomor < 10)
                    strcpy(arrKursi[indeks_kursi].nomor[nomor - 1], "X "); // operasi string
                else
                    strcpy(arrKursi[indeks_kursi].nomor[nomor - 1], " X "); // operasi string
                update_kursi();                                             // pemanggilan prosedur

                if (i == banyak_kursi - 1)
                    ulang = 0;
                else
                    i = i + 1;
            }
        } while (ulang == 1);

        system("cls");
        kode(arrFilm[opsi - 1].film, hari, data_kursi, kode_booking); // pemanggilan prosedur

        printf("======= Data Booking =======\n");
        printf("Nama Film \t: %s\n", arrFilm[opsi - 1].film);
        printf("Hari \t\t: %s\n", hari);
        printf("Kursi \t\t: ");
        for (int i = 0; i < banyak_kursi; i++) // loop
            printf("%s ", data_kursi[i]);
        printf("\nKode Booking \t: %s", kode_booking);
        printf("\nSisa Saldo \t: %d", arrAcc[idx].balance);
        printf("\nSelamat Menonton!!!");
    }
}

void urut_AZ(int N) // Sorting berdasarkan abjad
{
    for (int i = 0; i < N - 1; i++)
    {
        for (int j = i + 1; j < N; j++)
        {
            if (strcmp(arrStream[i].film, arrStream[j].film) > 0)
            {
                temp = arrStream[i];
                arrStream[i] = arrStream[j];
                arrStream[j] = temp;
            }
        }
    }
}

void urut_Genre(int N) // Sorting berdasarkan genre
{
    for (int i = 0; i < N - 1; i++)
    {
        for (int j = i + 1; j < N; j++)
        {
            if (strcmp(arrStream[i].genre, arrStream[j].genre) > 0)
            {
                temp = arrStream[i];
                arrStream[i] = arrStream[j];
                arrStream[j] = temp;
            }
        }
    }
}

void urut_Berbayar(int N) // Sorting berdasarkan film yang berbayar
{
    for (int i = 0; i < N - 1; i++)
    {
        for (int j = i + 1; j < N; j++)
        {
            if (strcmp(arrStream[i].status, arrStream[j].status) < 0)
            {
                temp = arrStream[i];
                arrStream[i] = arrStream[j];
                arrStream[j] = temp;
            }
        }
    }
}

void streaming(int idx, int N, int *kembali)
{
    int opsi, opsi_film;
back:
    printf("=============== Streaming ===============\n");
    printf("1. Cari Film\n");
    printf("2. Rekomendasi\n");
    printf("3. Kembali\n");
    do // loop
    {
        printf("Opsi : ");
        scanf("%d", &opsi);
        fflush(stdin);
    } while (opsi > 3 && opsi < 1);
halut:
    if (opsi == 3) // Percabangan
    {
        system("cls");
        *kembali = 1;
    }
    else
    {
        *kembali = 0;
        switch (opsi) // percabangan
        {
        case 1:
            system("cls");
            printf("Pilih Tampilan Pencarian\n");
            printf("1. A-Z\n");
            printf("2. Genre\n");
            printf("3. Kembali\n");

            do // loop
            {
                printf("Opsi : ");
                scanf("%d", &opsi);
                fflush(stdin);
            } while (opsi > 3 && opsi < 1);

            if (opsi == 1) // percabangan
            {
                urut_AZ(N);                 // pemanggilan prosedur
                for (int i = 0; i < N; i++) // loop
                    printf("\n%d. %-20s %-10s", i + 1, arrStream[i].film, arrStream[i].status);
            }
            else if (opsi == 2)
            {
                urut_Genre(N);              // pemanggilan prosedur
                for (int i = 0; i < N; i++) // loop
                {
                    if (strcmp(arrStream[i].genre, arrStream[i - 1].genre) != 0) // operasi string
                        printf("\n%s\n", arrStream[i].genre);
                    printf("%d. %-20s %-10s\n", i + 1, arrStream[i].film, arrStream[i].status);
                }
            }
            else if (opsi == 3)
            {
                system("cls");
                goto back; // goto statement
            }

            printf("\nPilihan : ");
            scanf("%d", &opsi_film);
            fflush(stdin);
            break;
        case 2:
            system("cls");
            urut_Berbayar(N); // pemanggilan prosedur
            printf("Rekomendasi film (berbayar)\n");
            for (int i = 0; i < N; i++) // loop
            {
                if (strcmp(arrStream[i].status, "Berbayar") == 0) // operasi string
                    printf("%d. %s\n", i + 1, arrStream[i].film);
            }
            printf("\nPilihan : ");
            scanf("%d", &opsi_film);
            fflush(stdin);
            break;
        }

        if (strcmp(arrStream[opsi_film - 1].status, "Berbayar") == 0) // percabangan dan operasi string
        {
            char null[5];
            for (int i = 0; i < 3; i++) // loop
            {
                if (strcmp(arrAcc[idx].movie[i], arrStream[opsi_film - 1].film) == 0) // percabangan
                {
                    system("cls");
                    printf("Selamat Menonton!");
                    Sleep(2000);
                    break;
                }
                else if (i == 2)
                {
                    char pil;
                    printf("\nAnda Belum Memiliki Film ini, silahkan membeli dengan harga Rp25.000\n");

                    do // loop
                    {
                        printf("Beli (Y / N) ? ");
                        scanf("%c", &pil);
                        fflush(stdin);
                    } while (pil != 'Y' && pil != 'y' && pil != 'N' && pil != 'n');

                    if (pil == 'Y' || pil == 'y') // percabangan
                    {
                        if (25000 > arrAcc[idx].balance) // percabangan
                        {
                            system("cls");
                            printf("Saldo Anda Tidak Mencukupi, Silahkan Isi Pada Menu Informasi Akun");
                            Sleep(2000);
                            system("cls");
                            *kembali = 1;
                            break;
                        }
                        else
                        {
                            for (int j = 0; j < 3; j++) // loop
                            {
                                if (strcmp(arrAcc[idx].movie[j], null) == 0) // operasi string
                                {
                                    strcpy(arrAcc[idx].movie[j], arrStream[opsi_film - 1].film); // operasi string
                                    arrAcc[idx].balance = arrAcc[idx].balance - 25000;
                                    update_akun(); // pemanggilan prosedur
                                    break;
                                }
                            }
                            system("cls");
                            printf("Selamat Menonton!");
                            Sleep(2000);
                        }
                    }
                    else if (pil == 'N' || pil == 'n')
                    {
                        goto halut;
                    }
                }
            }
        }
        else if (strcmp(arrStream[opsi_film - 1].status, "-") == 0)
        {
            system("cls");
            printf("Selamat Menonton!");
            Sleep(2000);
        }
        if (*kembali != 1)
        {
            if (strcmp(arrStream[opsi_film - 1].film, "The Batman") == 0) // percabangan
                system("TB.mkv");
            else if (strcmp(arrStream[opsi_film - 1].film, "The King's Man") == 0)
                system("TKM.mkv");
            else if (strcmp(arrStream[opsi_film - 1].film, "Frozen 2") == 0)
                system("F2.mp4");
            else if (strcmp(arrStream[opsi_film - 1].film, "Coco") == 0)
                system("Coco.mkv");
            else if (strcmp(arrStream[opsi_film - 1].film, "The Meg") == 0)
                system("TM.mp4");
            else if (strcmp(arrStream[opsi_film - 1].film, "Resident Evil") == 0)
                system("RE.mkv");
        }
    }
}

int main()
{
    int indeks_akun, opsi, kembali_halut;

logout:
    login(&indeks_akun); // pemanggilan prosedur
kembali:
    halaman_utama(&opsi); // pemanggilan prosedur
    if (opsi == 1)        // percabangan
    {
        system("cls");
        streaming(indeks_akun, 6, &kembali_halut); // pemanggilan prosedur
        if (kembali_halut == 1)
            goto kembali; // goto statement
    }
    if (opsi == 2)
    {
        system("cls");
        booking(indeks_akun, &kembali_halut); // pemanggilan prosedur
        if (kembali_halut == 1)
            goto kembali; // goto statement
    }
    else if (opsi == 3)
    {
        system("cls");
        info_akun(indeks_akun, &kembali_halut); // pemanggilan prosedur
        if (kembali_halut == 1)
            goto kembali; // goto statement
    }
    else if (opsi == 4)
    {
        system("cls");
        goto logout; // goto statement
    }
    else if (opsi == 5)
    {
        system("exit"); // exit
    }
    return 0;
}
