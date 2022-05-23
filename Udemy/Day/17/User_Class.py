#When naming classes, EVERY word starts with a capital letter AKA Pascal Case
#Camel Case is likeThis
#Snake case is_like_this

class User:
    def __init__(self, user_id, username):
        self.username = username
        self.id = user_id
        self.followers = 0
        self.following = 0

    def follow(self,userToFollow):
        userToFollow.followers += 1
        self.following += 1


user1 = User("001", "Drip")
user2 = User("002", "Jimbo")

user1.follow(user2)
print(user1.followers)
print(user1.following)
print(user2.followers)
print(user2.following)




