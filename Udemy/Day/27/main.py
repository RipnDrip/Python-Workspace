#Creating windows and labels
import tkinter

window = tkinter.Tk()

window.title("My First GUI Program")
window.minsize(width=500, height=500)

#Label
my_label = tkinter.Label(text="I'm a label atr ", font=("Ariel", 25, "bold"))
my_label.pack(side="left")
my_label.pack(expand=True)



import turtle

tin = turtle.Turtle()
tin.write("This is a Turtle", font=("Times New Roman", 12, "bold"))








window.mainloop()