#documentacion para modelos
#https://platform.openai.com/docs/models/gpt-3-5

import openai
import config

openai.api_key = config.api_key
# contexto del assitente, ecplicar despues
messages = [{"role": "system",
             "content": "Eres un asistente muy util para programar html y css"}]
while True:

    prompt = input("Escribe algo: ")

    if prompt == "exit":
        break

    messages.append({"role":"user","content":prompt})
    response = openai.ChatCompletion.create(
                                 model="gpt-3.5-turbo", # modelos diferentes
                                 messages=messages)
    response_content = response.choices[0].message.content
    messages.append({"role":"assistant","content":response_content})
    print(response_content)









#Parte 1. sin while, mostrar el json
    # response = openai.ChatCompletion.create(model="gpt-3.5-turbo", # modelos diferentes
    #                              messages=[{"role":"user","content":"¿cual es tu mision?"}]) #estructura de array, ya que hay pregunta y respuesta
    # print(response)

#Parte 2: eligiendo solo la parte de mensajes
    # response = openai.ChatCompletion.create(model="gpt-3.5-turbo", # modelos diferentes
    #                              messages=[{"role":"user","content":"¿cual es tu mision?"}])
    #print(response.choices[0].message.content)

#Parte 3: creamos la variable prompt y le asignamos un input()
    #prompt = input("Escribe algo: ")
    # response = openai.ChatCompletion.create(model="gpt-3.5-turbo", # modelos diferentes
    #                              messages=[{"role":"user","content":prompt}])
    #print(response.choices[0].message.content)

#Parte 4: creamos var messages y el rol system. podriamos condicionar las respues de entrada
    #messages = [{"role":"system",
                #"content": "Eres un asistente de traduccion"}] # para algo muy muy concreto este contexto
    # prompt = input("Escribe algo: ")
    # response = openai.ChatCompletion.create(model="gpt-3.5-turbo", # modelos diferentes
    #                              messages=[{"role":"user","content":prompt}])
    # print(response.choices[0].message.content)


#Parte 5. append para no perder el contexto
    #messages = [{"role":"system",
                #"content": "Eres un asistente de traduccion"}] # para algo muy muy concreto este contexto
    # prompt = input("Sobre que quieres hablar?: ")
    #messages.append({"role":"user","content":prompt})
    # response = openai.ChatCompletion.create(model="gpt-3.5-turbo", # modelos diferentes
    #                              messages=messages)<--------cambiar a messages
    # print(response.choices[0].message.content)

#Parte 6: agregamos un bucle while:
# hasta este punto todavia no guardamos las respuestas
# podemos guardar respuestas pero no el contexto
     #messages = [{"role":"system",
                    #"content": "Eres un asistente de traduccion"}] # para algo muy muy concreto este contexto
    #while True:
        # prompt = input("Sobre que quieres hablar?: ")
        # if prompt == "exit":
            #break
        #messages.append({"role":"user","content":prompt})
        # response = openai.ChatCompletion.create(model="gpt-3.5-turbo", # modelos diferentes
        #                              messages=messages)<--------cambiar a messages
        # print(response.choices[0].message.content)

#Parte 7: aqui guardamos la respuesta, hacemos el response_content
    #messages = [{"role":"system",
                    #"content": "Eres un asistente de traduccion"}] # para algo muy muy concreto este contexto
    #while True:
        # prompt = input("Sobre que quieres hablar?: ")
        # if prompt == "exit":
            #break
        #messages.append({"role":"user","content":prompt})
        # response = openai.ChatCompletion.create(
        #                              model="gpt-3.5-turbo", # modelos diferentes
        #                              messages=messages)<--------cambiar a messages
        # response_content = response.choices[0].message.content
        # messages.append({"role":"assistant","content":response_content})
        # print(response_content)

#choices es un array, elegimos la respuesta
# message es lo que queremos,
# y que queremos del message? pues el contenido

# prompt: lo que escriba se guarda en el prompt,
# y luego se le pasa como peticion este texto a openai