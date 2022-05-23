from socket import *
# In order to terminate the program
import sys

port = ("localhost", 25782)
serverSocket = socket(AF_INET, SOCK_STREAM)
# Prepare a sever socket
# Fill in start
serverSocket.bind(port)
serverSocket.listen(1)
print("The Browser is connected to port:", port[1])
# Fill in end

while True:
    # Establish the connection
    print('Ready to serve...')
    connectionSocket, address = serverSocket.accept()
    print('Connection accepted')
    try:
        message = connectionSocket.recv(1024)

        filename = message.split()[1]
        f = open(filename[1:])
        output_data = f.read()

        # Send one HTTP header line into socket
        # Fill in start
        connectionSocket.send('\nHTTP/1.1 200 OK\n\n'.encode())
        connectionSocket.send(output_data.encode())
        # Fill in end

        # Send the content of the requested file to the client
        for i in range(0, len(output_data)):
            connectionSocket.send(output_data[i].encode())
        connectionSocket.send("\r\n".encode())

        connectionSocket.close()
    except IOError:
        # Send response message for file not found
        # Fill in start
        print("404 Not Found")
        connectionSocket.send('\nHTTP/1.1 404 Not Found\n\n'.encode())
        # Fill in end

        # Close client socket
        # Fill in start
        connectionSocket.close()
        # Fill in end

# Terminate the program after sending the corresponding data
    serverSocket.close()
    print("Server closed.")
    sys.exit()
