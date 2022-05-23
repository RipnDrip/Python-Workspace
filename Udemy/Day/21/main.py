class Animal:
    def __init__(self):
        self.num_eyes = 2


    def breathe(self):
        print("*Breathes*")

class Fish(Animal):
    def __init__(self):
        super().__init__()

    def swim(self):
        print("*Swims*")

    def breathe(self):
        print("*Breathes but underwater*")

tony = Animal()
tony.breathe()

nemo = Fish()
nemo.breathe()


