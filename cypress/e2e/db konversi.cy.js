context('Database Konversi', () => {
  // untuk mengisi formulir login dan password lalu mengirim formulir
  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  beforeEach(() => {
    const url = 'http://localhost:8000/home'; // Ganti dengan URL yang sesuai
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url); 
  });

  it('Database Konversi', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    // Setelah login berhasil, navigasi ke route 'database_konversi'
    cy.visit('http://localhost:8000/database_konversi'); 
  });
});
