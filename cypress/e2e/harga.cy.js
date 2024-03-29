context('Daftar Harga', () => {
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

  it('Daftar Harga', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');
  
    // Navigasi ke route 'master_price' setelah login berhasil
    cy.visit('http://localhost:8000/master_price'); 
  });
  
});
