context('Circuit Non Single', () => {
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

  it('Next Proses', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    // Setelah login berhasil, navigasi ke route 'next_proses'
    cy.visit('http://localhost:8000/next_proses'); 
  });
});
