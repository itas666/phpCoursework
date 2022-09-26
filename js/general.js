async function fetchData(collection, dataFilter){
    //Reference to feedback
    const feedback = document.querySelector("#manageBox");

    //Extract data from form
    //let name = document.querySelector("#deptName").value;
    //let desc = document.querySelector("#deptDescription").value;

    //Build object with data
    let searchParams = {
        collection: collection,
        criteria: dataFilter
    }

    //Send JSON data to server
    try{
        //Post data to server
        let response = await fetch("fetchDB.php", {
            method: 'POST', 
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(searchParams) 
        });

        //Output result
        let responseText = await response.text();
        if(response.ok){
            feedback.innerHTML = responseText;
        }
        else{
            console.log("Error loading data for collection with filter " + collection + "--" + dataFilter);
        }
    }
    catch(err){
        console.error("Communication problem: " + JSON.stringify(err));
        console.log("Error loading data for collection with filter " + collection + "--" + dataFilter);
    }
}

async function fetchManageProducts(dataFilter){
    //Reference to feedback
    const feedback = document.querySelector("#manageBox");

    //Build object with data
    let searchParams = {
        criteria: dataFilter
    }

    //Send JSON data to server
    try{
        //Post data to server
        let response = await fetch("manageFetchProds.php", {
            method: 'POST', 
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(searchParams) 
        });

        //Output result
        let responseText = await response.text();
        if(response.ok){
            feedback.innerHTML = responseText;
        }
        else{
            console.log("Error loading data for collection with filter " + collection + "--" + dataFilter);
        }
    }
    catch(err){
        console.error("Communication problem: " + JSON.stringify(err));
        console.log("Error loading data for collection with filter " + collection + "--" + dataFilter);
    }
}


async function addDepartment(deptId){
    //Reference to feedback
    const feedback = document.querySelector("#Feedback");

    //Extract data from form
    let name = document.querySelector("#name").value;
    let description = document.querySelector("#description").value;

    //Build object with data
    let department = {
        _id: deptId,
        collection: "department",
        name: name,
        description: description
    }

    //Send JSON data to server
    try{
        //Post data to server
        let response = await fetch("manageDB.php", {
            method: 'POST', 
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(department) 
        });

        //Output result
        let responseText = await response.text();
        console.log(responseText);
        if(response.ok){
            console.log(name + " added succesfully.");
            fetchData("department", null);
        }
        else{
            console.log("Error adding department");
        }
    }
    catch(err){
        console.error("Communication problem: " + JSON.stringify(err));
        console.log("Error adding department");
    }
}


async function deleteFromDb(itemId, collection){
    //Reference to feedback
    const feedback = document.querySelector("#Feedback");

    //Build object with data
    let item = {
        _id: itemId,
        collection: collection
    }

    //Send JSON data to server
    try{
        //Post data to server
        let response = await fetch("deleteFromDb.php", {
            method: 'POST', 
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(item) 
        });

        //Output result
        let responseText = await response.text();
        console.log(responseText);
        if(response.ok){
            console.log("Deleted");
            console.log(collection);
            if(collection == "product"){
                fetchManageProducts(null);
            }else{
                fetchData(collection, null);
            }
            
        }
        else{
            console.log("Error deleting");
        }
    }
    catch(err){
        console.error("Communication problem: " + JSON.stringify(err));
        console.log("Error deleting");
    }
}

async function addUser(userId){
    //Reference to feedback
    const feedback = document.querySelector("#Feedback");

    //Extract data from form
    let name = document.querySelector("#name").value;
    let surname = document.querySelector("#surname").value;
    let password = document.querySelector("#password").value;
    let email = document.querySelector("#email").value;
    let phone = document.querySelector("#phone").value;
    let isAdmin = document.querySelector("#isAdmin").value;
    let isEnabled = document.querySelector("#isEnabled").value;

    //Build object with data
    let user = {
        _id: userId,
        collection: "user",
        name: name,
        surname: surname,
        password: password,
        email: email,
        phone: phone,
        isAdmin: isAdmin,
        isEnabled: isEnabled
    }

    //Send JSON data to server
    try{
        //Post data to server
        let response = await fetch("manageDB.php", {
            method: 'POST', 
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(user) 
        });

        //Output result
        let responseText = await response.text();
        console.log(responseText);
        if(response.ok){
            console.log(name + " added succesfully.");
            fetchData("user", null);
        }
        else{
            console.log("Error adding department");
        }
    }
    catch(err){
        console.error("Communication problem: " + JSON.stringify(err));
        console.log("Error adding department");
    }
}

async function addProduct(prodId){
    //Reference to feedback
    const feedback = document.querySelector("#Feedback");
    if(prodId === null){
        actionFlag = "add";
    }else{
        actionFlag = "edit";
    }

    //Extract data from form
    let name = document.querySelector("#" + actionFlag + "name").value;
    let shortDescription = document.querySelector("#" + actionFlag + "shortDescription").value;
    let longDescription = document.querySelector("#" + actionFlag + "longDescription").value;
    let price = document.querySelector("#" + actionFlag + "price").value;
    let tags = document.querySelector("#" + actionFlag + "tags").value;
    let departmentId = document.querySelector("#" + actionFlag + "departmentId").value;
    if(prodId === null){
        let imagePaths = "";
    }else{
        let imagePaths = document.querySelector("#imagePaths").value;
    }

    //Build object with data
    let prod = {
        _id: prodId,
        collection: "product",
        name: name,
        shortDescription: shortDescription,
        longDescription: longDescription,
        price: price,
        tags: tags,
        departmentId: departmentId,
        imagePaths: imagePaths
    }

    //Send JSON data to server
    try{
        //Post data to server
        let response = await fetch("manageDB.php", {
            method: 'POST', 
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(prod) 
        });

        //Output result
        let responseText = await response.text();
        console.log(responseText);
        if(response.ok){
            console.log(name + " added succesfully.");
            fetchManageProducts(null);
        }
        else{
            console.log("Error adding department");
        }
    }
    catch(err){
        console.error("Communication problem: " + JSON.stringify(err));
        console.log("Error adding department");
    }
}



async function gatherProdData(prodId){
    //Reference to feedback
    const feedback = document.querySelector("#mainBody");
    if(prodId === null){
        actionFlag = "add";
    }else{
        actionFlag = "edit";
    }

    let formData = {
        _id: prodId,
        action: "edit"
    }
    
    //Send JSON data to server
    try{
        //Post data to server
        let response = await fetch("gatherProdData.php", {
            method: 'POST', 
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formData)
        });

        //Output result
        let responseText = await response.text();
        console.log(responseText);
        if(response.ok){
            console.log(" loaded succesfully.");
            feedback.innerHTML = responseText;
        }
        else{
            console.log("Error loading product");
        }
    }
    catch(err){
        console.error("Communication problem: " + JSON.stringify(err));
        console.log("Error loading product");
    }
}