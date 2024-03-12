context('Edit Circuit Single', () => {
  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  const fillForm = (data) => {
    Object.keys(data).forEach((label) => {
      cy.get(`label:contains("${label}") + input`).type(data[label]);
    });
  };

  beforeEach(() => {
    const url = 'http://localhost:8000/home';
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url);
  });

  it('Edit Data', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');
  
    cy.visit('http://localhost:8000/konsep_commonize');
    cy.wait(1000);
  
    // Pilih checkbox pertama
    cy.get('.sub_chk').first().check();
  
    // Klik tombol "Edit"
    cy.contains('Edit').click();  

    // Data yang akan diisi pada formulir edit
    const editFormData = {
      "114A": '114A',
      "Model": 'SULVUS',
      "Ukuran": '0.5',
      "Warna": 'W-B',
      "CL": '134',
      "Terminal B": 'SOLDER0',
      "Acc bag b1": 'Z092-1153-15',
      "Acc bag b2": '-',
      "Tube B": '0097-3358-00',
      "Terminal A": '0411-1697-20',
      "Acc bag a1": '0100-6923-17',
      "Acc bag a2": '-',
      "Tube A": '0097-3358-00'
    };

    // Mengisi formulir dengan data yang diberikan
    fillForm(editFormData);

    // Klik tombol SIMPAN
    cy.get('button.btn-success').click();
  });
});
