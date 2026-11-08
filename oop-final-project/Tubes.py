from abc import ABC, abstractmethod
from time import sleep
from datetime import datetime
import os
import json

BASE_DIR = os.path.dirname(os.path.abspath(__file__))


dict_user = {}
dict_theatre = {}
dict_stream = {}


class abstract(ABC):
    @abstractmethod
    def tampilan():
        pass

    @abstractmethod
    def opsi():
        pass


class writeREAD():
    def __init__(self, opsi):
        self.opsi = opsi

    def write(self):
        if (self.opsi == 1):
            with open(os.path.join(BASE_DIR, 'File', 'list_akun.txt'), 'w') as file:
                file.write(json.dumps(dict_user, indent=10))
        elif (self.opsi == 2):
            with open(os.path.join(BASE_DIR, 'File', 'list_movies.txt'), 'w') as file:
                file.write(json.dumps(dict_theatre, indent=10))
        elif (self.opsi == 3):
            with open(os.path.join(BASE_DIR, 'File', 'list_stream.txt'), 'w') as file:
                file.write(json.dumps(dict_stream, indent=10))

    def read(self):
        if (self.opsi == 1):
            with open(os.path.join(BASE_DIR, 'File', 'list_akun.txt')) as file:
                data = file.read()
            return data
        elif (self.opsi == 2):
            with open(os.path.join(BASE_DIR, 'File', 'list_movies.txt')) as file:
                data = file.read()
            return data
        elif (self.opsi == 3):
            with open(os.path.join(BASE_DIR, 'File', 'list_stream.txt')) as file:
                data = file.read()
            return data


class login(abstract):
    def tampilan(self):
        print("===================================================")
        print("================== <Tick&Stream> ==================")
        print("===================================================")
        print("1. Sign In")
        print("2. Sign Up")
        self.opsi()

    def opsi(self):
        while True:
            pil = int(input("-> "))
            if (pil == 1):
                self.__login()
            elif (pil == 2):
                self.__daftar()
            else:
                print("Pilihan Tidak Tersedia")
                continue
            break

    def __login(self):
        os.system('cls')
        while True:
            print("========= <Sign In> =========")
            user_log = input("Username : ")
            pass_log = input("Password : ")
            ulang = self.checkuser(user_log, pass_log)
            if (ulang == 0):
                os.system('cls')
                print("Sign In Berhasil!")
                sleep(3)
                os.system('cls')
                if (user_log == "admin"): #Admin
                    admin().tampilan()
                else:
                    halaman_utama(user_log)
            elif (ulang == 1):
                os.system('cls')
                print("Username/Password Salah!")
                sleep(3)
                os.system('cls')
                continue
            elif (ulang == 2):
                os.system('cls')
                print("Username Tidak Ada!")
                sleep(3)
                os.system('cls')
                continue
            break

    def __daftar(self):
        while True:
            os.system('cls')
            print("========= <Sign Up> =========")
            nama_reg = input("Nama \t\t: ")
            user_reg = input("Username \t: ")
            pass_reg = input("Password \t: ")
            ulang = self.checkuser(user_reg, pass_reg)
            if (ulang == 0 or ulang == 1):
                os.system('cls')
                print("Username Sudah Ada!")
                sleep(3)
                os.system('cls')
                continue
            elif (ulang == 2):
                os.system('cls')
                dict_user[user_reg] = {}
                dict_user[user_reg]["Password"] = pass_reg
                dict_user[user_reg]["Nama"] = nama_reg
                dict_user[user_reg]["Movie"] = {}
                dict_user[user_reg]["Balance"] = 0
                simpan = writeREAD(1)
                simpan.write()
                print("Sign Up Berhasil! Silahkan Sign In")
                sleep(3)
                os.system('cls')
                self.tampilan()
            break

    def checkuser(self, user, password):
        if user in dict_user:
            if (dict_user[user]["Password"] == password):
                return 0
            else:
                return 1
        else:
            return 2


class halaman_utama(login, abstract):
    def __init__(self, user):
        self.user = user
        self.tampilan()

    def tampilan(self):
        print("======== <Halaman Utama> ========")
        print("1. Streaming")
        print("2. Booking Ticket")
        print("3. Informasi akun")
        print("4. Log Out")
        print("5. Keluar")
        self.opsi()

    def opsi(self):
        while True:
            input_opsi = int(input("Masukkan Pilihan : "))
            if input_opsi > 5 or input_opsi < 1:
                print("Pilihan tidak tersedia!")
                continue
            elif input_opsi == 1:
                Stream(self.user)
            elif input_opsi == 2:
                booking(self.user)
            elif input_opsi == 3:
                self.__info_akun()
            elif input_opsi == 4:
                self.__logout()
            elif input_opsi == 5:
                self.__keluar()
            break

    def __info_akun(self):
        os.system('cls')
        print("===== Informasi Akun =====")
        print("Nama \t\t:", dict_user[self.user]["Nama"])
        print("Balance \t:", dict_user[self.user]["Balance"])
        print("Koleksi \t:", end='')
        if dict_user[self.user]["Movie"]:
            print("")
            for key in dict_user[self.user]["Movie"]:
                print("\t\t{}. {}".format(key, dict_user[self.user]["Movie"][key]))
        else:
            print(" -")

        while True:
            top_up = input("\nApakah Anda ingin melakukan Top Up (Y / N)? ")
            if top_up == 'Y' or top_up == 'y':
                while True:
                    nom = int(input("Masukkan Nominal \t: "))
                    if nom < 1:
                        print("Nominal Tidak Valid")
                        continue
                    else:
                        dict_user[self.user]["Balance"] += nom
                        os.system('cls')
                        simpan = writeREAD(1)
                        simpan.write()
                        print("Top Up Berhasil")
                        sleep(3)
                        self.__info_akun()
                    break
            elif top_up == 'N' or top_up == 'n':
                os.system('cls')
                self.tampilan()
            else:
                print("Pilihan Tidak Valid")
                continue
            break

    def __logout(self):
        os.system('cls')
        print("Berhasil Log Out!")
        sleep(3)
        os.system('cls')
        login().tampilan()

    def __keluar(self):
        exit()


class admin(login, abstract):
    def tampilan(self):
        print("===================================================")
        print("================== <Tick&Stream> ==================")
        print("===================================================")
        print("1. Input Film (Bioskop)")
        print("2. Input Film (Stream)")
        print("3. Log Out")
        self.opsi()

    def opsi(self):
        while True:
            pil = int(input("-> "))
            if (pil == 1):
                self.__tambahticket()
            elif (pil == 2):
                self.__tambahfilm()
            elif (pil == 3):
                self.__logout()
            else:
                print("\nPilihan Tidak Tersedia")
                continue
            break

    def __tambahfilm(self):
        os.system('cls')
        print("===== Input Film (Stream) =====")
        banyak_film = int(input("Banyak Film: "))
        for i in range(banyak_film):
            print("\nFilm", i + 1)
            a = 1
            while True:
                if str(a) in dict_stream.keys():
                    a += 1
                    continue
                else:
                    dict_stream[str(a)] = {}
                    dict_stream[str(a)]["Nama"] = input("Nama Film\t\t: ")
                    dict_stream[str(a)]["Kode"] = input("Kode Film\t\t: ")
                    dict_stream[str(a)]["Genre"] = input("Genre Film\t\t: ")
                    while True:
                        status = int(input("(1)Gratis (2)Berbayar\t: "))
                        if status == 1:
                            status = "Gratis"
                        elif status == 2:
                            status = "Berbayar"
                        else:
                            print("Pilihan Tidak Tersedia")
                            continue
                        break
                    dict_stream[str(a)]["Status"] = status
                break
        simpan = writeREAD(3)
        simpan.write()
        os.system('cls')
        print("Input Film Berhasil!")
        sleep(3)
        os.system('cls')
        self.tampilan()

    def __tambahticket(self):
        os.system('cls')
        dict_theatre.clear()
        print("===== Input Film (Bioskop) =====")
        banyak_film = int(input("Banyak Film : "))
        for i in range(banyak_film):
            print("\nFilm", i + 1)
            dict_theatre[i + 1] = {}
            dict_theatre[i + 1]["Nama"] = input("Nama Film \t: ")
            dict_theatre[i + 1]["Kode"] = input("Kode Film \t: ")
            dict_theatre[i + 1]["Hari"] = {}
            self.__importkursi(i + 1)
        simpan = writeREAD(2)
        simpan.write()
        os.system('cls')
        print("Input Film Berhasil!")
        sleep(3)
        os.system('cls')
        self.tampilan()

    def __importkursi(self, key):
        semua_hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"]
        semua_jam = ["10:30", "11:45", "13:50", "14:30", "15:45", "17:50", "18:30", "19:45", "21:50"]
        for hari in semua_hari:
            dict_theatre[key]["Hari"][hari] = {}
            for jam in semua_jam:
                dict_theatre[key]["Hari"][hari][jam] = {}
                for i in range(50):
                    if i < 9:
                        dict_theatre[key]["Hari"][hari][jam][i + 1] = " {}".format(i + 1)
                    else:
                        dict_theatre[key]["Hari"][hari][jam][i + 1] = str(i + 1)

    def __logout(self):
        os.system('cls')
        print("Berhasil Log Out!")
        sleep(3)
        os.system('cls')
        login().tampilan()


class Stream(halaman_utama, abstract):
    def __init__(self, user):
        self.user = user
        self.tampilan()

    def tampilan(self):
        os.system('cls')
        print("============================== Streaming ==============================")
        print("{:<5} {:<35} {:<20} {:<20}".format("No", "Nama", "Genre", "Status Film"))
        for i in dict_stream.keys():
            print("{:<5} {:<35} {:<20} {:<20}".format(i, dict_stream[i]["Nama"], dict_stream[i]["Genre"], dict_stream[i]["Status"]))
        self.opsi()

    def opsi(self):
        while True:
            pil = input("\nMasukkan Pilihan (0 untuk kembali) -> ")
            if pil in dict_stream.keys():
                self.pil = pil
                if dict_stream[self.pil]["Status"] == "Berbayar":
                    if dict_stream[self.pil]["Nama"] in dict_user[self.user]["Movie"].values():
                        os.system('cls')
                        print("Selamat Menonton!")
                        sleep(3)
                        self.__putarfilm()
                        input("\nTekan Enter Untuk Kembali")
                        self.tampilan()
                    else:
                        while True:
                            beli = input("Anda Belum Memiliki Film ini, Apakah Anda Ingin Membelinya (Rp50000) (Y / N)? ")
                            if (beli == 'Y' or beli == 'y'):
                                if (dict_user[self.user]["Balance"] < 35000):
                                    os.system('cls')
                                    print("Saldo Anda Tidak Cukup, Silahkan Top Up Melalui Menu Informasi Akun")
                                    sleep(3)
                                    os.system('cls')
                                    self.tampilan()
                                else:
                                    dict_user[self.user]["Balance"] -= 50000
                                    a = 1
                                    while True:
                                        if str(a) in dict_user[self.user]["Movie"].keys():
                                            a += 1
                                            continue
                                        else:
                                            dict_user[self.user]["Movie"][str(a)] = dict_stream[self.pil]["Nama"]
                                        break
                                    os.system('cls')
                                    print("Sisa Saldo Anda :", dict_user[self.user]["Balance"])
                                    print("Selamat Menonton!")
                                    simpan = writeREAD(1)
                                    simpan.write()
                                    sleep(3)
                                    self.__putarfilm()
                                    input("Tekan Enter Untuk Kembali")
                                    self.tampilan()
                            elif (beli == 'N' or beli == 'n'):
                                self.tampilan()
                            else:
                                print("Pilihan tidak Tersedia")
                                continue
                            break
                else:
                    os.system('cls')
                    print("Selamat Menonton!")
                    sleep(3)
                    self.__putarfilm()
                    input("\nTekan Enter Untuk Kembali")
                    self.tampilan()
            elif pil == '0':
                self.__kembali()
            else:
                print("Pilihan Tidak Tersedia")
                continue
            break

    def __putarfilm(self):
        namafilm = ".mp4"
        namafilm = dict_stream[self.pil]["Kode"] + namafilm
        directory = os.path.join(BASE_DIR, "Movies", "")
        directory += namafilm
        os.startfile(directory)

    def __kembali(self):
        os.system('cls')
        sleep(1)
        halaman_utama(self.user)


class booking(halaman_utama, abstract):
    def __init__(self, user):
        self.user = user
        self.tampilan()

    def tampilan(self):
        os.system('cls')
        print("===== Booking Tiket =====")
        print("Daftar Film (0 untuk kembali): ")
        for key in dict_theatre.keys():
            print("{}. {}".format(key, dict_theatre[key]["Nama"]))
        self.opsi()

    def opsi(self):
        while True:
            pil = input("-> ")
            if pil in dict_theatre.keys():
                self.pil = pil
                os.system('cls')
                print("Pilih Hari (0 untuk kembali) :")
                semua_hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"]
                i = 0
                for hari in semua_hari:
                    print("{}. {}".format(i + 1, hari))
                    i += 1
                while True:
                    hari = int(input("-> "))
                    if (hari > 0 and hari < 8):
                        self.hari = semua_hari[hari - 1]
                        os.system('cls')
                        print("Pilih Jam (0 untuk kembali) :")
                        semua_jam = ["10:30", "11:45", "13:50", "14:30", "15:45", "17:50", "18:30", "19:45", "21:50"]
                        i = 0
                        for jam in semua_jam:
                            print("{}. {}".format(i + 1, jam))
                            i += 1
                        while True:
                            jam = int(input("-> "))
                            if (jam > 0 and jam < 10):
                                self.jam = semua_jam[jam - 1]
                            elif (jam == 0):
                                os.system('cls')
                                sleep(1)
                                self.tampilan()
                            else:
                                print("Pilihan tidak tersedia")
                                continue
                            break
                        self.__tampilkursi()
                        jml_kursi = int(input("Jumlah Kursi yang Akan di Booking (0 untuk kembali) -> "))
                        if (jml_kursi == 0):
                            os.system('cls')
                            sleep(1)
                            self.tampilan()
                        elif (jml_kursi * 35000 > dict_user[self.user]["Balance"]):
                            os.system('cls')
                            print("Saldo Tidak Cukup, Silahkan Top Up Melalui Menu Informasi Akun")
                            sleep(3)
                            os.system('cls')
                            self.tampilan()
                        else:
                            kursi = []
                            dict_user[self.user]["Balance"] -= jml_kursi * 35000
                            for i in range(jml_kursi):
                                while True:
                                    print("\n{}".format(i + 1))
                                    nomor = int(input("Masukkan Kursi : "))
                                    if (nomor > 50 or dict_theatre[self.pil]["Hari"][self.hari][self.jam][str(nomor)] == " X"):
                                        print("Kursi Tidak Tersedia, silahkan pilih kursi yang lain\n")
                                        continue
                                    else:
                                        kursi.append(nomor)
                                        dict_theatre[self.pil]["Hari"][self.hari][self.jam][str(nomor)] = " X"
                                    break
                            kode = self.__kode()
                            os.system('cls')
                            print("======= Data Booking =======")
                            print("Nama Film \t:", dict_theatre[self.pil]["Nama"])
                            print("Hari \t\t:", self.hari)
                            print("Jam \t\t:", self.jam)
                            print("Kursi \t\t:", end=' ')
                            for i in kursi:
                                print(i, end=' ')
                            print("\nKode Booking \t:", kode)
                            print("Sisa Saldo \t:", dict_user[self.user]["Balance"])
                            print("Selamat Menonton!!!")
                            simpan = writeREAD(1)
                            simpan.write()
                            simpan = writeREAD(2)
                            simpan.write()
                        input("\nTekan enter untuk kembali...")
                        os.system('cls')
                        halaman_utama(self.user)
                    elif (hari == 0):
                        os.system('cls')
                        sleep(1)
                        self.tampilan()
                    else:
                        print("Pilihan Tidak Tersedia")
                        continue
                    break
            elif (pil == '0'):
                os.system('cls')
                sleep(1)
                self.__kembali()
            else:
                print("Pilihan Tidak Tersedia")
                continue
            break

    def __kode(self):
        now = datetime.now()
        hour = now.strftime("%H%M%S")
        kode = dict_theatre[self.pil]["Kode"] + hour
        return kode

    def __tampilkursi(self):
        os.system('cls')
        print("Film \t:", dict_theatre[self.pil]["Nama"])
        print("Hari \t:", self.hari)
        print("Jam \t:", self.jam)
        print("")
        a = 1
        for i in range(5):
            for j in range(10):
                if j == 5:
                    print("      ", end='')
                print("{}   ".format(dict_theatre[self.pil]["Hari"][self.hari][self.jam][str(a)]), end='')
                a += 1
            print("\n")
        print("\n=================== Layar Bioskop ===================\n")

    def __kembali(self):
        os.system('cls')
        sleep(1)
        halaman_utama(self.user)


if __name__ == "__main__":
    akun = writeREAD(1)
    akun = akun.read()
    dict_user = json.loads(akun)

    film = writeREAD(2)
    film = film.read()
    dict_theatre = json.loads(film)

    stream = writeREAD(3)
    stream = stream.read()
    dict_stream = json.loads(stream)

    start = login()
    start.tampilan()