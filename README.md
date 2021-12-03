Abril el terminal en esta carpeta y ejecutar:


cd unameet_adminuser_db
docker build -t unalmeet_adminuser_db .
docker run -p 3306:3306 --name unalmeet_adminuser_db unalmeet_adminuser_db
cd ..
cd unalmeet_adminuser_ms
docker build --no-cache -t unalmeet_adminuser_ms .
docker run -p 4040:80 --name unalmeet_adminuser_ms unalmeet_adminuser_ms