context('Reset Area Final', () => {
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

  it('Reset Area Final', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    // Setelah login berhasil, navigasi ke route 'area final'
    cy.visit('http://localhost:8000/data-fa-841w'); 

    // Temukan tombol reset berdasarkan teks
    cy.get('button:contains("Reset")').click();

  });
});
