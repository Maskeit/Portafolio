#Creado por Miguel Alejandre
#aqui pienso agregar otras herramientas utiles para facilitar el manejo del  codigo principal

#IMPORTANTE INSTALAR LOS REQUERIMIENTOS DEL ARCHIVO "requirements.txt" con $  pip install requierements.txt
#Llave de la api generada
api_key = "sk-"

#Roles
"""
openai.ChatCompletion.create(
  model="gpt-3.5-turbo",
  messages=[
        {"role": "system", "content": "You are a helpful assistant."}, el system maneja el contexto
        {"role": "user", "content": "Who won the world series in 2020?"}, nosotros
        {"role": "assistant", "content": "The Los Angeles Dodgers won the World Series in 2020."}, guarda el contexto
        {"role": "user", "content": "Where was it played?"}
    ]
)
"""