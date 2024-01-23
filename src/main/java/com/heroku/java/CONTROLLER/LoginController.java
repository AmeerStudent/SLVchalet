@PostMapping("/login")
    public String login(@RequestParam(name = "success", required = false) Boolean success, String inputUsername, String inputPassword, HttpSession session, Model model, customer customer) {

        try {
            // String returnPage = null;
            Connection connection = dataSource.getConnection();

            String sql = "SELECT custUsername, custName, custEmail, custPhoneno, custAddress, custPass FROM public.customer WHERE custUsername=?";
            final var statement = connection.prepareStatement(sql);
            statement.setString(1, inputUsername);

            final var resultSet = statement.executeQuery();

            System.out.println("customer : " + inputUsername);
            System.out.println("cust pass : " + inputPassword);

            if (resultSet.next()) {

                String custUsername = resultSet.getString("custUsername");
                String custPass = resultSet.getString("custPass");
                String custName = resultSet.getString("custName");
                String custEmail = resultSet.getString("custEmail");
                String custPhoneno = resultSet.getString("custPhoneno");
                String custAddress = resultSet.getString("custAddress");

                System.out.println(custUsername);
                
                System.out.println("Customer username : " + custUsername.equals(inputUsername) + " | " + inputUsername);
                System.out.println("Password : " + custPass.equals(inputPassword));

                if (custUsername.equals(inputUsername) && custPass.equals(inputPassword)) {

                    session.setAttribute("custUsername", inputUsername);
                    session.setAttribute("custUsername", inputPassword);
                    
                    return "redirect:/index?success=true";
                }
            }

            connection.close();
            return "redirect:/login?invalidUsername&Password";

        } catch (SQLException sqe) {
            System.out.println("Error Code = " + sqe.getErrorCode());
            System.out.println("SQL state = " + sqe.getSQLState());
            System.out.println("Message = " + sqe.getMessage());
            System.out.println("printTrace /n");
            sqe.printStackTrace();

            return "redirect:/login?error";

        } catch (Exception e) {
            System.out.println("E message : " + e.getMessage());
            return "redirect:/login?error";
        }

    }
