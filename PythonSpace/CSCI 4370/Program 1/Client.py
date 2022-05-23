from socket import *

# address to connect to server
# (localhost = 127.0.0.1, portNum)
port = ("localhost", 25384)
c = socket(AF_INET, SOCK_DGRAM)
print("connected to server.....")

#Prompt
name = input("Enter name: ")
n = int(input("Enter number between 1 to 100: "))
msg = f'Client of {name},' + str(n)

#Send message to port
c.sendto(msg.encode(), port)
data, address = c.recvfrom(4096)

# getting data from server
data = data.decode().strip().split(',')

print("Server Name: " + data[0])
print("Server generated number: " + data[1])
print("Sum of number: " + data[2])
