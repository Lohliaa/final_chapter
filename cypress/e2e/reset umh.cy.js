context('Reset Daftar UMH', () => {
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

  it('Reset Daftar UMH', () => {
    // Navigasi ke route 'umh_master' sudah terjadi dalam beforeEach
    cy.visit(`${baseUrl}/umh_master`);

    // Temukan tombol reset berdasarkan teks
    cy.get('button:contains("Reset")').click();
  });
});
