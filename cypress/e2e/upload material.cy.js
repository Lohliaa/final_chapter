context('Upload Excel Material', () => {
  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  beforeEach(() => {
    const url = 'http://localhost:8000/home';
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url);
  });

  it('Upload Data', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');
  
    cy.visit('http://localhost:8000/material');
    
    // Klik tombol "Upload Excel"
    cy.contains('Upload Excel').click(); 
  
    // Cari input file dan ubah nilai menggunakan fixture
    cy.get('input[type="file"]').attachFile('TRIAL 2241B - Copy.xlsx');

    cy.get('button[type="submit"]').click();
  }); 
});