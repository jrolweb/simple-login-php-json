<h1>Simple Login PHP/JSON</h1>
<p>PT-BR</p>

<h2>Introdução</h2>
<p>Simples sistema de login e gerenciamento de usuários usando PHP e JSON criado para estudo e utilização em pequenos projetos. O sistema conta com dois tipos de usuários para diferentes níveis de acesso a áreas restritas.</p>

<h2>Tipos de Usuário</h2>
<ul>
    <li>adm</li>
    <li>user</li>
</ul>
<h3>adm</h3>
<p>Usuário com permisão para cadastro, edição e exclusão de outros usuários.<p>

<h3>user</h3>
<p>Usuário com permisões básicas de acesso.</p>

<h2>Gerenciamento de Usuários</h2>
<ul>
    <li>Cadastro de novos usuários</li>
    <li>Edição de usuários (senha e tipo de usuário)</li>
    <li>Exclusão de usuários</li>
</ul>
<h2>Dados</h2>
<p>Este projeto não utiliza banco de dados, em vez disso, todos os dados dos usuários ficam armazenados no arquivo <strong>db.json</strong>.</p>

<h2>Segurança</h2>
<p>As senhas dos usuários cadastrados são criptografadas com <strong>MD5</strong>. O acesso direto ao arquivo <strong>db.json</strong> através do navegador é bloqueado pelo arquivo <strong>.htaccess</strong>.<p>

<h2>Instruções</h2>
<p>Não precisa de instalação de pacotes, basta baixar e usar em seu projeto.</p>
<p>Para o primeiro acesso utilize:</p>
<ul>
    <li>Usuário: test@test.com</li>
    <li>Senha: passtest</li>
</ul>

<h2>Licença</h2>
<ul>
    <li>MIT</li>
</ul>