import sys
import os
import base64
from openai import AzureOpenAI  
from azure.identity import DefaultAzureCredential, get_bearer_token_provider  

def main():
    # Parse input arguments
    if len(sys.argv) < 2:
        print("Usage: python openai_chat.py <user_message>")
        return
    
    user_message = sys.argv[1]

    endpoint = os.getenv("ENDPOINT_URL", "https://ai-23096183aibrighterus800207146867.openai.azure.com/")  
    deployment = os.getenv("DEPLOYMENT_NAME", "gpt-4o")  

    # Initialize Azure OpenAI client
    token_provider = get_bearer_token_provider(  
        DefaultAzureCredential(),  
        "https://cognitiveservices.azure.com/.default"  
    )  
    
    client = AzureOpenAI(  
        azure_endpoint=endpoint,  
        azure_ad_token_provider=token_provider,  
        api_version="2024-05-01-preview",  
    )  

    # Define chat prompt
    chat_prompt = [
        {"role": "user", "content": user_message}
    ]

    # Generate completion
    completion = client.chat.completions.create(  
        model=deployment,  
        messages=chat_prompt,
        max_tokens=800,  
        temperature=0.7,  
    )  
    
    print(completion.to_json())

if __name__ == "__main__":
    main()
