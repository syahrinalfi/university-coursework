# University Coursework

Projects from my Computer Engineering courses at Telkom University (2022–2025). The code is kept close to how it was submitted. The only changes are hardcoded Windows paths replaced with relative ones, test accounts renamed, and large or third-party files left out. Identifiers, comments and on-screen text are in Indonesian.

For my weekly Machine Learning assignments, see [MachineLearningTasks](https://github.com/syahrinalfi/MachineLearningTasks).

## Projects

| Folder | Course | Year | What it is |
|---|---|---|---|
| [`c-final-project/`](c-final-project/) | Algorithms & Programming lab (Praktikum Algoritma Pemrograman) | 2022 | **Tick&Stream** in C: a console app for booking cinema seats and renting streaming films, with sign-up/sign-in and admin tools that build its data files |
| [`oop-final-project/`](oop-final-project/) | Object-Oriented Programming (Pemrograman Berorientasi Objek) | 2023 | **Tick&Stream** rebuilt in Python with classes, inheritance and an abstract base class: accounts with balances, cinema booking, streaming, and an admin page, stored as JSON |
| [`database-final-project/`](database-final-project/) | Database Design (Desain Basis Data) | 2023 | A survey system in PHP and MySQL: admins create surveys and questions, manage respondents and view answers; respondents register and fill in surveys. Includes the ERD and normalization diagrams |
| [`artificial-intelligence/`](artificial-intelligence/) | Artificial Intelligence (Kecerdasan Buatan) | 2024 | Search algorithms (BFS, DFS, Greedy Best-First Search) and a genetic algorithm that picks which rooms to build on a plot of land, maximizing priority within the area limit |
| [`deep-learning-final-project/`](deep-learning-final-project/) | Deep Learning | 2025 | Waste-type image classification (cardboard, glass, metal, paper, plastic, trash) with a CNN-BiLSTM (~74–76% validation accuracy) and YOLO11n-cls (91.5% top-1), each with a Flask upload-and-predict website |

The four final projects (C, OOP, database and deep learning) were group projects; the code here is our team's submission. The artificial-intelligence scripts are individual work. The C and Python final projects are the same app built twice: first procedurally in C, then object-oriented in Python.

## Final thesis

**Development of Indonesia National DVB-T2 Web-Based Mapping using Coverage Prediction ITU-R P.1546-6 Model**, a web system that maps the predicted coverage of Indonesia's digital-TV (DVB-T2) transmitters. Published at IEEE AGERS 2025: [IEEE Xplore](https://ieeexplore.ieee.org/document/11446435). The code was built as a team in a separate repository and isn't included here.

## Running

### `c-final-project/` (Windows only)

It uses `cls`, `Sleep` and opens video files. Compile with MinGW GCC from inside `c-final-project/`, so the relative `File/...` paths resolve:

```bat
gcc Tubes.c -o Tubes.exe
Tubes.exe
```

GCC 14 and newer treat one pointer-type mismatch in `Tubes.c` as an error. Add `-Wno-error=incompatible-pointer-types` to build it as submitted. The `Admin/` programs rewrite the data files in `File/`; run them from `c-final-project/` too (for example `gcc Admin\Input_Akun.c -o Input_Akun.exe`). The film files the app plays are not included, so playback fails.

### `oop-final-project/` (Windows for full use)

```bash
pip install tabulate
python oop-final-project/Tubes.py
```

Sign in with `admin` / `admin`, or `user1` / `user1`. It clears the screen with `cls` and plays films with `os.startfile`, so those parts work on Windows only, and the film files aren't included.

### `database-final-project/`

Built for XAMPP: put the folder in `htdocs`, import `tugas_besar.sql` into MySQL/MariaDB as database `tugas_besar`, and open `welcome.php`. `connect_db.php` uses XAMPP's default login (`root`, no password). Sample accounts: `admin@admin.admin` / `admin` and `don@don.don` / `don`.

This is coursework, not production code: queries are built from user input without prepared statements, and passwords are stored in plain text. Don't deploy it.

### `artificial-intelligence/`

```bash
python artificial-intelligence/BFS.py
python "artificial-intelligence/Greedy Best First Search.py"
pip install numpy matplotlib tabulate
python artificial-intelligence/ag_rumah_v1.py   # asks for generations, land area, crossover and mutation rate
```

### `deep-learning-final-project/`

Built with Muhammad Nadhim Abdirrahman and Syahrul Reza Ananda. The notebooks train on the Kaggle dataset [`farzadnekouei/trash-type-image-dataset`](https://www.kaggle.com/datasets/farzadnekouei/trash-type-image-dataset). `Tugas Besar.ipynb` is the CNN-BiLSTM and `Tugas_Besar_1.ipynb` is YOLO; YOLO's training curves and confusion matrices are in `runs/classify/train/`.

The YOLO website includes its trained model (`best.pt`, 3 MB):

```bash
pip install flask ultralytics opencv-python
cd "deep-learning-final-project/Website (YOLO)" && python app.py
```

The CNN-BiLSTM website needs `image_classification_model_2.h5`, which is 460 MB and not included; train it with `Tugas Besar.ipynb` and save it next to `app.py`.

## License

[MIT](LICENSE), except `deep-learning-final-project/`, which is [AGPL-3.0](deep-learning-final-project/LICENSE) because it uses [Ultralytics YOLO](https://github.com/ultralytics/ultralytics).
