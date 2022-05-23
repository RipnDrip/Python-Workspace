# Important info
# TCP sends and ICMP returns
# Use that to differentiate messages in list
# ICMP time - TCP tme = answer

line_num = sum(1 for line in open("sampletcpdump.txt", 'r+'))
#print(line_num)
file = open("sampletcpdump.txt", 'r+')

all_TCP = []
all_ICMP = []
while file:
    current_line = file.readline()
    if current_line == "":
        break

    check_protocol_TCP = current_line.find("TCP")
    check_protocol_ICMP = current_line.find("ICMP")

    curr_tcp = []
    if check_protocol_TCP != -1:
        curr_line_spl = current_line.split(",")
        tll_num = curr_line_spl[1].split(" ")[2]
        tcp_ip_speed = curr_line_spl[0].split(" ")[0]
        tcp_id_num = curr_line_spl[2][4:]
        curr_tcp.insert(0, tcp_id_num)
        curr_tcp.insert(1, tcp_ip_speed)
        curr_tcp.insert(2, tll_num)
        all_TCP.append(curr_tcp)

    curr_icmp = []
    ip_address = ""
    if check_protocol_ICMP != -1:
        count = 0
        curr_line_spl = current_line.split(",")
        icmp_ip_speed = curr_line_spl[0].split(" ")[0]
        icmp_id_num = curr_line_spl[2][4:]

        while count != 2:
            current_line = file.readline()
            curr_line_spl = current_line.strip().split(",")
            if count == 0:
                ip_address = current_line.strip().split(" ")[0]
            if count == 1:
                received_tcp_id = curr_line_spl[2][4:]
                pass
            count += 1


        curr_icmp.insert(0, icmp_id_num)
        curr_icmp.insert(1, icmp_ip_speed)
        curr_icmp.insert(2, received_tcp_id)
        curr_icmp.insert(3, ip_address)
        all_ICMP.append(curr_icmp)

x = 0
y = 0
pkt_counter = 0
found = False
while x != all_TCP.__len__():
    curr_tcp_speed = all_TCP[x][1]
    curr_tcp_id = all_TCP[x][0]
    pkt_counter = x

    if pkt_counter % 3 == 0 and x < all_ICMP.__len__():
        print(f"TTL {all_TCP[x][2]}")
        found = False

    while found is False and y != all_ICMP.__len__():
        checked_tcp_id = all_ICMP[y][2]
        # print(f"checked: {checked_tcp_id}")
        if curr_tcp_id == checked_tcp_id and x % 3 == 0:
            print(all_ICMP[y][3])

            check_pkt = 0
            while y != all_ICMP.__len__() and check_pkt < 3:
                time_exceeded = (float(all_ICMP[y][1]) - float(all_TCP[x][1])) * 1000
                t = round(time_exceeded, 3)
                print(f"{t} ms")
                check_pkt += 1
                y += 1

            found = True
            y = 0
            x+= 1
        else:
            y += 1

    x += 1
    pkt_counter += 1

file.close()
