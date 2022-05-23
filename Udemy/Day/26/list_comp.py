
numbers = [1,2,3,4,5]

#Long way
new_list = []
for n in numbers:
    add_1 = n+1
    new_list.append(add_1)

#short hand
# formula = new_item\item_modified for item in list
new_list = [n + 1 for n in numbers]

#Conditional
# formula = new_item\item_modified for item in list if test
names = ["Alex", "Beth", "Caroline", "Dave", "Elanor", "Freddie"]
short_names = [name for name in names if len(name) < 5]
long_names = [name for name in names if len(name) > 5]
print(names)
print(short_names)
print(long_names)
