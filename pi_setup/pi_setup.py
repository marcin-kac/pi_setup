import paramiko
import argparse
import getpass
from scp import SCPClient
from paramiko import SSHClient
import pprint
port = 22
parser = argparse.ArgumentParser()
parser.add_argument('-u','--username',type=str,dest="username",help='provide username')
parser.add_argument('-a','--address',type=str,dest="ip_address",help='ip_address of host to configure')
parser.add_argument('-c','--command',type=str,dest="cmd_list_file",help='command file to run on remote host ')
parser.add_argument('-f','--local_file',type=str,dest="local_file_list",help='file with remote command to executed on remote host ')

args = parser.parse_args()


cmd_list_file = args.cmd_list_file
ip_address = args.ip_address
username = args.username
password = getpass.getpass(prompt="Enter Pi Password: ")
command = open(cmd_list_file ,"r")
ssh = paramiko.SSHClient()
ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
ssh.connect(ip_address, port, username, password)

scp = SCPClient(ssh.get_transport())
local_file_list= args.local_file_list
file = open(local_file_list,"r")
file_list = file.readlines()
for local_file in file_list:
	scp.put(local_file.strip() ,'/tmp/'local_file.strip())
	print('file '+ local_file.strip() + ' copied to server')
scp.close()

for com in command:
	stdin, stdout, stderr = ssh.exec_command(com)
	response = stdout.readlines()
	print(*response, sep = "\n")
ssh.close()	


