
import requests # Lib para enviar la solicitud al servidor
import json # Lib para trabajar con el formato JSON
import platform # Lib para el serial
import os # Lib para el modelo
import datetime # Lib para la fecha y la hora
import subprocess # Lib para el nombre del fabricante y el procesador
import socket # Lib para el nombre del equipo
import psutil # Lib para identificar la RAM
import wmi # Lib para identificar los slot de la RAM

# Encabeza para la información
print ("\n")
print ("Soporte Técnico Integeratic SAS")
print ("Este programa fue desarrollado por el :")
print ("Departamento de Desarrollo de Software y Hardware de Integratic SAS.")
print ("Autores:")
print ("Denyer Bastida")
print ("Heimdall Rojas\n")

print ("Ficha Técnica :\n")
emprersa = ("Red de Salud del Oriente")

# Nombre del Tecnico:
# Heimdall Rojas
# Denyer Bastida
# Andrés Agudelo
# Michael Asprilla
# Steven Gomez

nom_tec = ("Denyer Bastida")
print(f"Nombre del Técnico : ", nom_tec)

# Fecha  y hora actual del registro
fecha_actual = datetime.datetime.now().strftime("%d-%m-%Y")
hora_actual = datetime.datetime.now().strftime("%H:%M:%S")
print("Fecha :", fecha_actual + " / " + "Hora : ", hora_actual + "\n")

# Datos adicionales
sede = input("Ingrese la Sede: ")
departamento = input("Ingrese el Departamento: ")
nom_usuario = input("Ingrese el Nombre del Usuario: ")
activo_fijo = input("Ingrese el Activo Fijo del Equipo: ")
tipo_equipo = input("Ingrese el Tipo de Equipo: ")

# Procesos para detectar los datos de computador
# Serial
if platform.system() == "Windows":
    c = os.popen("wmic bios get serialnumber").read()
    V_serial = c.split("\n")[2].strip()
    print("Serial: ", V_serial)

# Modelo    
    a = os.popen("wmic csproduct get name").read()
    V_modelo = a.split("\n")[2].strip()
    print("Modelo: ", V_modelo)
else:
    print("Este código solo funciona en sistemas operativos Windows")

# Fabricante
result = subprocess.run(['wmic', 'csproduct', 'get', 'vendor'], stdout=subprocess.PIPE, stderr=subprocess.PIPE)
fabricante = result.stdout.decode().strip().split("\n")[1]
print("Fabricante: ", fabricante)

# Nombre del equipo
nom_equipo = socket.gethostname()
print("Nombre del Equipo : ", nom_equipo)

# Procesador
result = subprocess.run('wmic cpu get name', stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
processor_model = result.stdout.strip().splitlines()[2].decode()
# print(f"Modelo de procesador: {processor_model}")
print("Procesador: ",processor_model)

# Memoria RAM
def get_ram_space():
    ram = psutil.virtual_memory()
    total = ram.total / (1024 ** 3)
    return total
ram_capacity = get_ram_space()
formatted_ram_capacity = round(ram_capacity, 1)
print("Memoria RAM: {:.2f} GB".format(get_ram_space()))

# Slot de memoria ram
# Crea una instancia del objeto WMI para acceder a la información del hardware
w = wmi.WMI()
# Obtiene el número total de ranuras de memoria RAM
slots = w.Win32_PhysicalMemoryArray()[0].MemoryDevices
# Imprime el número total de ranuras
print("Ranuras de memoria RAM:", slots)

# Discos
# Obtener la información del disco
disks = psutil.disk_partitions()
disk_info = []
print("Discos :")
for disk in disks:
    try:
        disk_usage = psutil.disk_usage(disk.mountpoint)
        total = disk_usage.total / (1024 ** 3)
        disk_info.append({"mountpoint": disk.mountpoint, "capacity": "{:.2f} GB".format(total)})
    except PermissionError:
        # Ignorar errores de permisos y continuar con el siguiente disco
        continue
    
    
# Imprimir los valores de mountpoint y capacity para cada disco
for disk in disk_info:
    print("Unidad:", disk["mountpoint"])
    print("Capacidad:", disk["capacity"])

# Convertimos la lista a formato JSON
discos_json = json.dumps(disk_info)

clave = input("Ingrese la clave: ")

if clave == "4020":
    print("Clave correcta. Procediendo con el proceso de subida a la base de datos...\n")
    # Aquí va el código para enviar los datos al servidor
    #--------------------------------------------------------------------------------------------------------------------------------
    # Servidor
    url = "https://sys.integratic.com.co/soporte_RSO/proceso.php"
    # Local
    # url = "http://localhost/Proyectos_Integratic/Sistema RSO/herramienta desarrollada en python/proceso.php"
    #--------------------------------------------------------------------------------------------------------------------------------
    # Datos que quieres enviar
    data = {
    "empresa":emprersa,    
    "nombre": nom_tec,
    "fecha": fecha_actual,
    "hora" : hora_actual,
    "sede": sede,
    "departamento": departamento,
    "nom_usuario": nom_usuario,
    "activo_fijo": activo_fijo,
    "tipo_equipo": tipo_equipo,
    "serial": V_serial,
    "modelo": V_modelo,
    "fabricante": fabricante,
    "nom_equipo" : nom_equipo,
    "processor_model" : processor_model,
    "ram" : formatted_ram_capacity,
    "slots" : slots,
    "discos": discos_json
    }
  # Enviar la solicitud POST
    response = requests.post(url, data=data)

    # Imprimir la respuesta del servidor
    print(response.text)

else:
    print("Clave incorrecta. El programa se cerrará.")
    # sys.exit()
    quit()

input('Presione "Enter" para finalizar el registro de la ficha técnica')

