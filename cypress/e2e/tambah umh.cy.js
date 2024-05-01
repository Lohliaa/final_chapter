context('Tambah Daftar UMH', () => {
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

  it('Tambah Daftar UMH', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/umh_master');
    cy.wait(1000);

    // Cari berdasarkan teks
    cy.contains('Tambah').click();

    // Temukan elemen formulir dan isi dengan data yang diberikan
    cy.get('label:contains("Kav") + input').first().type('214Y');
    cy.get('label:contains("Code 10") + input').first().type('0.0010');
    cy.get('label:contains("Code 20") + input').first().type('0.0021');
    cy.get('label:contains("Code 30") + input').first().type('0.0031');
    cy.get('label:contains("Process 10") + input').first().type('0');
    cy.get('label:contains("Process 20") + input').first().type('0');
    cy.get('label:contains("Process 30") + input').first().type('0');
    cy.get('label:contains("Charge") + input').first().type('2.22');
    // Klik tombol SIMPAN
    cy.get('button.btn-success').click();

  });
});