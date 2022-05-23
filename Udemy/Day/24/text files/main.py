# opens file, reads, prints and automatically closes at the end
with open("Test_Text.txt") as file:
    contents = file.read()
    print(contents)

# opens file, writes and automatically closes at the end
# mode "r" is default
# mode  "w" deletes and writes line
# mode "a" appends the line
with open("Test_Text.txt", mode="a") as file:
    file.write("\nThis is a new line bro.")

# If it the file doesn't exist, in w mode it will create it for yoo
# Only works in w mode
with open("New_Test_Text.txt", mode="w") as file:
    file.write("\nThis is a new file my guy.")

# You can start from C:\Users\teriq\PycharmProjects\Udemy\Day\24 to get
# a file from the same folder or you can change paths