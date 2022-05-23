sentence = "What is the Airspeed Velocity of an Unladen Swallow?"
# Don't change code above 👆
#formula
#new_dict = {new_key:new_value for (key,value) in dict.items()}
# Write your code below:
result = {word:len(word) for word in sentence.split()}


print(result)
