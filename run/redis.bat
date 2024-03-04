@echo off

REM Entrar no WSL e executar três comandos
wsl bash -c "sudo service redis-server start && sleep 1 && redis-cli"

