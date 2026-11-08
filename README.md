# University Coursework

Selected projects from my Computer Engineering courses at Telkom University (2022–2024). The code is kept close to how it was submitted. The only changes are hardcoded Windows paths replaced with relative ones, and test accounts renamed. Identifiers, comments and on-screen text are in Indonesian.

For my weekly Machine Learning assignments, see [MachineLearningTasks](https://github.com/syahrinalfi/MachineLearningTasks).

## Projects

| Folder | Course | Year | What it is |
|---|---|---|---|
| [`c-final-project/`](c-final-project/) | Algorithms & Programming lab (Praktikum Algoritma Pemrograman) | 2022 | **Tick&Stream** in C: a console app for booking cinema seats and renting streaming films, with sign-up/sign-in and admin tools that build its data files |
| [`oop-final-project/`](oop-final-project/) | Object-Oriented Programming (Pemrograman Berorientasi Objek) | 2023 | **Tick&Stream** rebuilt in Python with classes, inheritance and an abstract base class: accounts with balances, cinema booking, streaming, and an admin page, stored as JSON |
| [`artificial-intelligence/`](artificial-intelligence/) | Artificial Intelligence (Kecerdasan Buatan) | 2024 | Search algorithms (BFS, DFS, Greedy Best-First Search) and a genetic algorithm that picks which rooms to build on a plot of land, maximizing priority within the area limit |

The two final projects are the same app built twice: first procedurally in C, then object-oriented in Python.

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

### `artificial-intelligence/`

```bash
python artificial-intelligence/BFS.py
python "artificial-intelligence/Greedy Best First Search.py"
pip install numpy matplotlib tabulate
python artificial-intelligence/ag_rumah_v1.py   # asks for generations, land area, crossover and mutation rate
```

## License

[MIT](LICENSE)
