package com.heroku.java.CONTROLLER;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestParam;

import com.heroku.java.MODEL.*;

import jakarta.servlet.http.HttpSession;

import java.sql.*;
import javax.sql.DataSource;
import java.util.ArrayList;
import java.util.Map;

import java.util.List;

@Controller
public class LoginController {
    private final DataSource dataSource;

    @Autowired
    public LoginController(DataSource dataSource) {
        this.dataSource = dataSource;
    }

    @PostMapping("/admin")
    public String admin(@RequestParam(name = "success", required = false) Boolean success, String inputId, String inputPass, HttpSession session, Model model, staff staff) {

        try {
            // String returnPage = null;
            Connection connection = dataSource.getConnection();

            String sql = "SELECT staffId ,staffPass FROM public.staff WHERE staffId=?";
            final var statement = connection.prepareStatement(sql);
            statement.setString(1, inputId);

            final var resultSet = statement.executeQuery();

            System.out.println("ID: " + inputId);
            System.out.println("password : " + inputPass);

            if (resultSet.next()) {

                String staffId = resultSet.getString("staffId");
                String staffPass = resultSet.getString("staffPass");

                System.out.println(staffId);
                // if they're admin
                System.out.println("Id : " + staffId.equals(inputId) + " | " + inputId);
                System.out.println("Password status : " + staffPass.equals(inputPass));

                if (staffId.equals(inputId) && staffPass.equals(inputPass)) {
//session ni nama nak panggil bila-bila nanti
                    session.setAttribute("adminId", inputId);
                    session.setAttribute("staffPass", inputPass);
                    
                    return "redirect:/index?success=true";
                }   
            }

            connection.close();
            return "redirect:/admin?invalidUsername&Password";

            

        } catch (SQLException sqe) {
            System.out.println("Error Code = " + sqe.getErrorCode());
            System.out.println("SQL state = " + sqe.getSQLState());
            System.out.println("Message = " + sqe.getMessage());
            System.out.println("printTrace /n");
            sqe.printStackTrace();

            return "redirect:/admin?error";

        } catch (Exception e) {
            System.out.println("E message : " + e.getMessage());
            return "redirect:/admin?error";
        }

    }
//nama kat method () takboleh sama dengan database
    @PostMapping("/loginstaff")
    public String loginstaff(@RequestParam(name = "success", required = false) Boolean success, HttpSession session, Model model, String inputStaffId, String inputStaffPass, Model Model, staff staff) {

        try {
            // String returnPage = null;
            Connection connection = dataSource.getConnection();

            String sql = "SELECT staffId, staffName, staffEmail, staffPass, staffPhoneNo, adminId FROM public.staff WHERE staffId=?";
            final var statement = connection.prepareStatement(sql);
            //nama yang declare kat atas
            statement.setString(1, inputStaffId);

            final var resultSet = statement.executeQuery();

            System.out.println("staff pass : " + inputStaffPass);
            System.out.println("staff : " + inputStaffId);

            if (resultSet.next()) {

            	String staffId = resultSet.getString("staffId");
                String staffName = resultSet.getString("staffName");
                String staffEmail = resultSet.getString("staffEmail");
                String staffPass = resultSet.getString("staffPass");
                String staffPhoneNo = resultSet.getString("staffPhoneNo");
                String adminId = resultSet.getString("adminId");

                System.out.println(staffName);
                // if they're admin
                System.out.println("Id : " + staffId.equals(inputStaffId) + " | " + staffId);
                System.out.println("Password status : " + staffPass.equals(inputStaffPass));

                if (staffId.equals(inputStaffId)
                        && staffPass.equals(inputStaffPass)) {

                    session.setAttribute("staffName", staffName);
                    session.setAttribute("staffId", inputStaffId);

                    if (staffName.equals("Admin")) {
                        session.setAttribute("staffName", "Admin");
                        connection.close();
                        
                        // debug
                        System.out.println("manager name : " + staffName);
                        System.out.println("manager id: " + adminId);
                        return "redirect:/admindashboard?success=true";

                    } else {

                        // debug
                        System.out.println("staff name : " + staffName);
                        System.out.println("staff id: " + staffId);
                        return "redirect:/staffdashboard?success=true";
                    }

                }
            }
                connection.close();
            return "redirect:/index?invalidUsername&Password";
            
             } catch (SQLException sqe) {
            System.out.println("Error Code = " + sqe.getErrorCode());
            System.out.println("SQL state = " + sqe.getSQLState());
            System.out.println("Message = " + sqe.getMessage());
            System.out.println("printTrace /n");
            sqe.printStackTrace();

            return "redirect:/index?error"; 
        } catch (Exception e) {
            System.out.println("E message : " + e.getMessage());
            return "redirect:/index?error";
        }
        
        
        }
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
                    
                    return "redirect:/product?success=true";
                }
            }

            connection.close();
            return "redirect:/product?invalidUsername&Password";

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

    @GetMapping("/logout")
    public String logout(HttpSession session) {
        session.invalidate();
        return "redirect:/";
    }
}


    
