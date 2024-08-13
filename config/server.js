// server.js

const express = require('express');
const bodyParser = require('body-parser');
const path = require('path');
const connection = require('./db.js');
 
const app = express();
const port = 3000;

// Middleware para tratar dados do formulário
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Servir arquivos estáticos (como seu index.html)
app.use(express.static(path.join(__dirname, 'public')));

// Rota para lidar com o formulário enviado
app.post('/form', (req, res) => {
    const { name, lastname, date_birth, cpf, email, phone, password, gender } = req.body;
    const insertQuery = `INSERT INTO clients (name, lastname, date_birth, cpf, email, phone, password, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?);`;
    const values = [name, lastname, date_birth, cpf, email, phone, password, gender];

    // Executar a query SQL
    connection.query(insertQuery, values, (err, result) => {
        if (err) {
            console.error('Erro ao inserir dados no MySQL:', err);
            res.status(500).json({ message: 'Erro ao inserir dados no MySQL.' });
        } else {
            console.log('Dados inseridos com sucesso!');
            res.status(200).json({ message: 'Dados inseridos com sucesso!' });
        }
    });
});

// Iniciar o servidor
app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});
