const mysql = require('mysql2');

// Configurar a conexão
const connection = mysql.createConnection({
    host: 'localhost',    // Endereço do servidor MySQL
    user: 'root',         // Nome de usuário do MySQL
    password: 'kauan/21010300', // Senha do MySQL
    database: 'supermercado',   // Nome do banco de dados
    port: 3306            // Porta do MySQL
});

// Conectar ao banco de dados
connection.connect((err) => {
    if (err) {
        console.error('Erro ao conectar ao banco de dados: ' + err.stack);
        return;
    }
    console.log('Conectado ao banco de dados com sucesso. ID da conexão: ' + connection.threadId);
});

// Exportar a conexão para ser usada em outros arquivos
module.exports = connection;
