const signInForm = $("#signInForm");

signInForm.on("submit", function (e) {
    e.preventDefault();
    const formData = new FormData($(this)[0]);
    axios
        .post("/sign-in", formData)
        .then(function (response) {
            let r = response.data;
            if (r.status === "success") {
                window.location = r.url;
            }
        })
        .catch(function (error) {
            alertError(error);
            console.log(error);
        })
        .finally(() => {
        });
});

const signUpForm = $("#signUpForm");

signUpForm.on("submit", function (e) {
    e.preventDefault();
    const formData = new FormData($(this)[0]);
    axios
        .post("/sign-up", formData)
        .then(function (response) {
            let r = response.data;
            if (r.status === "success") {
                window.location = r.url;
            }
        })
        .catch(function (error) {
            alertError(error);
            console.log(error);
        })
        .finally(() => {
        });
});


function alertError(error) {
    if (error.response && error.response.status === 422) {
        // Laravel validation errors (422 Unprocessable Entity)
        let errors = error.response.data.errors;
        let errorMessages = Object.values(errors)
            .flat()
            .join("\n");
        alert(errorMessages);
    } else if (error.response && error.response.data.message) {
        // General error message
        alert(error.response.data.message);
    } else if (error.response.status) {
        // Custom error message
        alert(error.response.message);
    } else {
        // Fallback error message
        alert("An unexpected error occurred. Please try again.");
    }
}