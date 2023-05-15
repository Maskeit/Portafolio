#Prompt por MIGUEL ALEJANDRE
# Documentacion: https://platform.openai.com/docs/introduction

import openai
import config
import typer
from rich import print
from rich.table import Table

def main():
    openai.api_key = config.api_key

    print("[bold green]ChatGPT en Python[/bold green]")

    table = Table()
    table.add_column("Comando")
    table.add_column("Descripción")
    table.add_row("exit", "Salir de la aplicación")
    table.add_row("new", "Crear nuevo contexto")
    print(table)

    context ={"role": "system",
              "content": "Eres un asistente muy útil"}
    messages = [context]

    while True:
        content = __prompt()

        if content == "new":
            print("Nueva conversación: ")
            messages = [context]
            content = __prompt()

        messages.append({"role": "user", "content": content})

        response = openai.ChatCompletion.create(model="gpt-3.5-turbo", messages=messages)

        response_content = response.choices[0].message.content

        messages.append({"role": "assistant", "content": response_content})

        print(f"[bold green]> [/bold green] [green]{response_content}[/green]")

def __prompt() -> str:
    prompt = typer.prompt("\n¿Sobre qué quieres hablar? ")

    if prompt == "exit":
        print("¡Hasta luego!")
        exit = typer.confirm("¿Estás seguro?")
        if exit:
            raise typer.Abort()
        return __prompt()

    return prompt

if __name__ == "__main__":
    typer.run(main)
