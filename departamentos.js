document.getElementById('link-produtos1').addEventListener('click', function() {
    carregarProdutos('departamentos/animais.html');
});

document.getElementById('link-produtos2').addEventListener('click', function() {
    carregarProdutos('departamentos/bazar_utilidades.html');
});

document.getElementById('link-produtos3').addEventListener('click', function() {
    carregarProdutos('departamentos/bebidas.html');
});

document.getElementById('link-produtos4').addEventListener('click', function() {
    carregarProdutos('departamentos/biscoito_chocolate.html');
});
    
document.getElementById('link-produtos5').addEventListener('click', function() {
    carregarProdutos('departamentos/carnes.html');
});
    
document.getElementById('link-produtos6').addEventListener('click', function() {
    carregarProdutos('departamentos/cereais_farinaceos.html');
});

document.getElementById('link-produtos7').addEventListener('click', function() {
    carregarProdutos('departamentos/congelados.html');
});

document.getElementById('link-produtos8').addEventListener('click', function() {
    carregarProdutos('departamentos/frios_laticinios.html');
});
    
document.getElementById('link-produtos9').addEventListener('click', function() {
    carregarProdutos('departamentos/hortifruti.html');
});
    
document.getElementById('link-produtos10').addEventListener('click', function() {
    carregarProdutos('departamentos/limpeza.html');
});

document.getElementById('link-produtos11').addEventListener('click', function() {
    carregarProdutos('departamentos/mercearia.html');
});
    
document.getElementById('link-produtos12').addEventListener('click', function() {
    carregarProdutos('departamentos/padaria.html');
});
    
document.getElementById('link-produtos13').addEventListener('click', function() {
    carregarProdutos('departamentos/perfumaria_higiene.html');
});


function carregarProdutos(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('produto-lista').innerHTML = data;
        })
        .catch(error => {
            console.error('Erro ao carregar os produtos:', error);
        });
}
