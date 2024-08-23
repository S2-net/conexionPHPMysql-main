
<body>
    
    <?php require("header.php");
    ?>

    <div class="content">

        <div class="tipo">
            <label for="universidades">Universidades</label>
            <select name="universidades" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>- Cualquiera -</option>
                <option value="1">Cenur</option>
                <option value="2">Udelar</option>
              </select>
        </div>
        
          <div class="tipo">
            <label for="departamentos">Departamentos</label>
            <select name="departamentos" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>- Cualquiera -</option>
                <option value="1">Paysandú</option>
              </select>
          </div>
          
          <div class="tipo">
            <label for="tipos">Tipos</label>
            <select name="tipos" class="form-select form-select-lg mb-3" aria-label="Large select example">
                <option selected>- Cualquiera -</option>
                <option value="1">Mixtas</option>
                <option value="2">Masculinas</option>
                <option value="3">Femeninas</option>
              </select>
          </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>