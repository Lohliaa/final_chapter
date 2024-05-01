context('Tambah Data Item', () => {
  // untuk mengisi formulir login dan password lalu mengirim formulir
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

  it('Tambah Data', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/item');
    cy.wait(1000);

    // Cari berdasarkan teks
    cy.contains('Tambah').click();

    // Temukan elemen formulir dan isi dengan data yang diberikan
    cy.get('label:contains("Component Number") + input').first().type('NBA 0.5 R');
    cy.get('label:contains("Specific Component Number") + input').first().type('68002345910');
    cy.get('label:contains("Component Name") + input').first().type('68002345910');

    // Klik tombol SIMPAN
    cy.get('button.btn-success').click();

  });
});