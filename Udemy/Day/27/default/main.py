def my_function(a=1,b=2,c=3):
    a = b
    b = c
    print(a)

    def add(*args):
        for n in args:
            print(n)