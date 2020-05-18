# trainee-php-sort

## About

trainee-php-sort is a program that we developed from the beginning with plenty of sort parameter options and is an imitation of the standard sort command, and it includes quickSort and mergeSort, 
so that you have various options in terms of sorting and with which algorithm you want to sort.

See below for more details on the parameters, how to use them and what they are for.

### Parameters
| Parameter      |                 Usage |
| ----------- | ----------- |
| -b   |    Ignore leading blanks.       |
| -f   |    Ignore case e.g (uppercase or lowercase) this would be ignored.       |
| -n   |    Numeric sort from the lowest the highest.       |
| -o   |    Write result in FILE instead of standard output.       |
| -r   |    Reverse the result of sorting.       |
| -R   |    Sort the keys using a random hash.       |
| -u   |    Only output the first of several matches.       |
| --qsort | Use quick sort Algorithm.       |
| --mergesort  | Use merge sort Algorithm.       |
| --help  | Display this help and exit the Program.       |

### Examples of commands...
In the following I will show you a few examples of how the commands are execute.

These are what I have as content in the ``in.txt`` file.
```
13
8
12
6
2
10
1
7
0
```

As you can see, the numbers are completely mix up.
And when we execute these commands, the numbers are sort very precisely.
``php sort.php -n in.txt`` OR ``php sort.php -n < in.txt``.
```
0
1
2
6
7
8
10
12
13
```
If you don't like bubble sort, you can still sort with `` --qsort '' or `` mergesort ''.
You only have to enter one of the two names when executing, as in the following example..
``php sort.php -n --qsort in.txt`` OR ``php sort.php --mergsort in.txt`` and the output is exactly the same.
```
0                                        0
1                                        1
2                                        2
6                                        6
7                                        7
8                                        8
10                                       10
12                                       12
13                                       13
```

If you want to save the output in a new file, you just have to enter the -o parameter followed by a file name. ``php sort.php -n --qsort -o output.txt in.txt``.