context('Reset Database Konversi', () => {
  const baseUrl = 'http://localhost:8000';

  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  beforeEach(() => {
    const url = `${baseUrl}/home`;
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url);
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');
  });

  it('Reset Database Konversi', () => {
    // Navigasi ke route 'database_konversi' sudah terjadi dalam beforeEach
    cy.visit(`${baseUrl}/database_konversi`);

    // Temukan tombol reset berdasarkan teks
    cy.get('button:contains("Reset")').click();
  });
});
