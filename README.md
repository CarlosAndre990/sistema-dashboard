## 🚀 README.md: Sistema de Dashboard Administrativo em PHP & MySQLi

Este repositório contém um sistema de dashboard administrativo completo, desenvolvido em PHP, utilizando MySQLi para interação com o banco de dados e Bootstrap 5 para um layout profissional e responsivo com barra lateral (Sidenav) e relatórios visuais (Chart.js).

---

### 1. ⚙️ Tecnologias Utilizadas

| Tecnologia | Função Principal |
| :--- | :--- |
| **Backend** | PHP (Procedural) | Lógica de servidor, autenticação, manipulação de dados. |
| **Banco de Dados** | MySQL (via MySQLi) | Armazenamento de usuários (`users`) e dados de alunos (`alunos`). |
| **Frontend** | Bootstrap 5 | Layout, responsividade, componentes de UI. |
| **Gráficos** | Chart.js | Visualização moderna de dados (dashboard). |
| **Segurança** | MD5 | Hashing básico de senhas (na inserção e login). |

---

### 2. 📁 Estrutura de Arquivos

Abaixo estão os arquivos principais do sistema e suas responsabilidades:

| Arquivo | Descrição |
| :--- | :--- |
| `index.php` | **Tela de Login** (UI moderna). Recebe e-mail e senha. |
| `telacadastro.php` | **Tela de Cadastro de Usuário** (UI moderna). Registra novos administradores. |
| `login.php` | Script de **Autenticação**. Verifica as credenciais e inicia a sessão. |
| `cadastro.php` | Script de **Registro**. Insere novo usuário no DB com senha criptografada (MD5). |
| `painel.php` | **Dashboard Principal** (Layout Profissional com Sidebar). Central de navegação. |
| `estatisticas.php` | **Tela de Relatórios**. Contém os 6 gráficos e 4 métricas de análise (requer adaptação ao novo layout). |
| `conexao.php` | Configuração de **Conexão** com o banco de dados MySQL. |
| `verifica_login.php` | **Guarda de Rota**. Garante que apenas usuários logados acessem o dashboard. |
| `logout.php` | Script de **Encerramento de Sessão**. Redireciona para o login. |
| `novo_formulario_aluno.php` | (Placeholder) Tela para cadastro dos alunos, deve ser adaptada ao novo layout. |

---

### 3. 💾 Configuração do Banco de Dados (SQL)

Para iniciar o projeto, você precisará criar a base de dados (`login`) e a tabela de usuários (`users`).

#SQL da Tabela `users` (Usuários do Sistema)

```sql
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL UNIQUE,
  `user_password` varchar(32) NOT NULL, -- 32 caracteres para hash MD5
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

B. Estrutura Assumida da Tabela alunos (Usada em Relatórios)
O sistema de relatórios (estatisticas.php) requer uma tabela para os dados. Assumimos a seguinte estrutura (a ser complementada pelo estudante):
CREATE TABLE `alunos` (
  `aluno_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `idade` int(3) NOT NULL,
  `curso` varchar(100) NOT NULL,
  `status` enum('Ativo', 'Inativo', 'Trancado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

C. Código de Conexão (conexao.php)
Certifique-se de que os dados do seu arquivo conexao.php correspondam à sua configuração local:

PHP

<?php
define('HOST', 'localhost');
define('USUARIO', 'root'); // Seu usuário MySQL
define('SENHA', '');      // Sua senha MySQL
define('DB', 'login');    // Nome da base de dados

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não foi possível conectar');
?>

4.
As senhas são armazenadas utilizando a função MD5.

Exemplo de Inserção de Senha (cadastro.php):
PHP

// Criptografia e Inserção
$senha_md5 = MD5($senha); 
$sql = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$nome', '$email', '$senha_md5')";
// ... código de execução

5.Consultas de Relatórios (Exemplo Básico)
O arquivo estatisticas.php é responsável por extrair dados do banco para os gráficos. Um exemplo básico de consulta para uma métrica seria:

PHP

// Consulta para obter o número total de alunos
$sql_total_alunos = "SELECT COUNT(aluno_id) AS total FROM alunos";
$result_total_alunos = mysqli_query($conexao, $sql_total_alunos);
$data_total_alunos = mysqli_fetch_assoc($result_total_alunos);
$total_alunos = $data_total_alunos['total']
