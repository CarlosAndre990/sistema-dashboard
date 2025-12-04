Tela de login -->
Apresenta o formulário de login. Sua função é coletar as credenciais (e-mail e senha) e submetê-las ao login.php via método POST, além de ser o ponto de redirecionamento em casos de falha de autenticação ou logout.
<img width="1363" height="645" alt="image" src="https://github.com/user-attachments/assets/790c614f-d643-47ff-985d-3f9a4d035458" />

Tela de Cadastro-->
Fornece a estrutura visual (HTML/CSS) para a criação de novas contas. Sua responsabilidade é exibir os campos obrigatórios (nome, e-mail, senha), capturar a entrada do usuário e submeter esses dados ao módulo de processamento (cadastro.php), garantindo a integridade e a usabilidade do formulário.
<img width="1366" height="643" alt="image" src="https://github.com/user-attachments/assets/a709e08d-dbf5-4f27-9f2f-21f75e3fa2a2" />


Painel -->
É a interface central pós-login. Exibe indicadores-chave de performance (KPIs) e gráficos de distribuição, utilizando dados mock (temporários), enquanto o banco de dados não está totalmente conectado. Serve como hub de navegação primário através do menu lateral.
<img width="1364" height="643" alt="image" src="https://github.com/user-attachments/assets/7564a407-d69f-401a-abb2-0bd6ad915b1f" />

Cadastro de alunos-->
Fornece a estrutura de formulário (HTML) para a inserção detalhada de novos alunos (dados pessoais, curso e responsáveis). Sua única função é coletar e validar a entrada de dados antes de submetê-los ao processa_aluno.php.
<img width="1350" height="648" alt="image" src="https://github.com/user-attachments/assets/6a587d52-cae4-4b96-82d2-41adec1c8dbc" />

Estatísticas-->
Módulo dedicado à visualização de dados agregados. Executa consultas de contagem (COUNT) e agrupamento (GROUP BY) nas tabelas (users e alunos) para calcular e exibir métricas detalhadas (totais, distribuição por curso, etc.) em formato de relatórios tabulares e gráficos.
<img width="1364" height="646" alt="image" src="https://github.com/user-attachments/assets/d16d09e7-1a63-4319-aaae-4b8ddbce2e52" />






