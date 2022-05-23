def add(*args):

    print(args[1])
    sum = 0
    for n in args:
        sum += n
    return sum

print(add(3,5,6,5,8,9,2,1))

def calculate(n, **kwargs):
    print(kwargs)
    # for key, value in kwargs.items():
    #     print(key)
    #     print(value)
    n += kwargs["add"]
    n *= kwargs["multiply"]
    print(n)

calculate(6, add=3, multiply=5)

class Car:
    def __init__(self,**kw):
        self.make = kw.get("make")
        self.model = kw.get("model")
        self.color = kw.get("color")
        self.seats = kw.get("seats")


my_car = Car(make="Nissan", model="370z",color="Orange",seats=2)

