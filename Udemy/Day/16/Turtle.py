import some_module

print(some_module.some_var)

from turtle import Turtle, Screen
jimbo = Turtle()
#same as:
# import turtle
# [some code]
# jimbo = turtle.Turtle()

print(jimbo) #prints reference to jimbo

jimbo.shape("turtle")
jimbo.color("Sky Blue")
jimbo.forward(100)

my_screen = Screen()
print(my_screen.canvheight)
my_screen.exitonclick()
