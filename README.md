# publico
Esse projeto foi desenvolvido para simular uma API simples de cadastro de usuário.
Requerimentos:
- PHP version >= 8
- Ubuntu 20.4
- Docker version >= 20.10.7
- Vue js version = 3
- Node version >= 16.14.0
- Laravel version 8

#### Criando ambiente e instando recursos de forma automática #########
Atenção: só faça essa etapa em um ambiente Docker, evite fazer isso em maquinas do dia a dia.
1 – crie uma pasta na raiz do seu Linux(container) chamada publico.
2- clone o projeto, após termina valide se a estrutura de pasta está assim publico(backend, frontend e doker-publico).
3 – acesse a pasta Docker-publico de permissão no arquivo run-in-machine.bat, rode ./ run-in-machine, isso vai instalar todas as dependências e subir os ambiente.
4 – rode um Docker ps para validar se os container subiram, são três, mysql, nginx e o php.
5- acesse a pasta frontend e rode o comando npm install.
6- acesse a pasta backend e rode o comando composer install, crie seu arquivo .env e adicione algumas variáveis de ambiente para o docker.
    
    PORT_DOCKER=80
    DIRETORIO_APP_DOCKER=/publico/backend

    #### atenção as vezes o Docker pode ter problemas na conexão observe a baixo
    DB_CONNECTION=mysql
    #DB_HOST=127.0.0.1 -> use para rodar migrate, seed e etc.
    DB_HOST=mysql -> use para rodar quando precisa acessar pela web
    DB_PORT=3306
    DB_DATABASE=publico
    DB_USERNAME=publico
    DB_PASSWORD=publico
    
7- acesse a pasta frontend e rode o comando npm run serve, normalmente você vai acessar o vue pela link http://localhost:8080/.
Agora basta testar os recursos

#### Outros comandos importantes ###########
 Para desligar os container acesse a pasta /publico/Docker-publico e rode o comando a baixo
docker-compose --env-file ../backend/.env down
------------------------------
Para ligar os container de novo rode
docker-compose --env-file ../backend/.env up -d --build 

#### Caso vocês tenha problema na conexão com mysql segue comandos para auxilia o processo
sudo apt-get install php7.4-mysql
sudo apt-get install php8.0-mysql
sudo apt-get install php8.1-mysql
