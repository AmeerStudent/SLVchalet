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

import com.heroku.java.MODEL.customer;

import jakarta.servlet.http.HttpSession;

import java.sql.*;
import javax.sql.DataSource;
import java.util.ArrayList;
import java.util.Map;

import java.util.List;

@Controller
public class CustomerController {
    private final DataSource dataSource;

    @Autowired
    public CustomerController(DataSource dataSource) {
        this.dataSource = dataSource;
    }

 
@GetMapping("/signup")
    public String signup() {
        return "signup";
    }

@PostMapping ("/signup")
public String signup(@ModelAttribute("signup")customer customer){
    try{
        Connection connection = dataSource.getConnection();
        String sql = "INSERT INTO public.customer(custId, custPhoneNo, custEmail, custName, custPass, custAddress) VALUES (?,?,?,?,?,?)";
        final var statement = connection.prepareStatement(sql);

        String custId = customer.getCustId();
        String custPhoneNo = customer.getCustPhoneNo();  
        String custEmail = customer.getCustEmail(); 
        String custName = customer.getCustName();
        String custPass = customer.getCustPass();
        String custAddress = customer.getCustAddress();

        statement.setString(1, custId);
		statement.setString(2, custPhoneNo);
	    statement.setString(3, custEmail);
		statement.setString(4, custName);
		statement.setString(5, custPass);
		statement.setString(6, custAddress);

        statement.executeUpdate();
         System.out.println("Customer name :" + custName);

        connection.close();

        } catch (Exception e) {
            e.printStackTrace();
            return "redirect:/index";
        }
        return "redirect:/customerList";
    }

    // @GetMapping("/customerList")
    // public String customerList(MODEL model){

    //     List<customer> customers = new ArrayList<customer>();
    //     try (Connection connection = dataSource.getConnection()) {
    //         String sql = "SELECT custId, custPhoneNo, custEmail, custName, custPass, custAddress FROM public.customer order by custId";
    //         final var statement = connection.prepareStatement(sql);
    //         final var resultSet = statement.executeQuery();
    //         System.out.println("pass try customerList >>>>>");

    //         while (resultSet.next()) {
    //             String custId = resultSet.getString("custId");
    //             String custPhoneNo = resultSet.getString("custPhoneNo");  
    //             String custEmail = resultSet.getString("custEmail"); 
    //             String custName = resultSet.getString("custName");
    //             String custPass = resultSet.getString("custPass");
    //             String custAddress = resultSet.getString("custAddress");

    //             customer customer = new customer();
    //             customer.setCustId(custId);
    //             customer.setCustPhoneNo(custPhoneNo);
    //             customer.setCustEmail(custEmail);
    //             customer.setCustName(custName);
    //             customer.setCustPass(custPass);
    //             customer.setCustAddress(custAddress);

    //             customers.add(customer);
    //             MODEL.addAttribute("customers", customers);

    //         }
    //         connection.close();
    //          return "customerList";
    //         } catch (SQLException e) {
    //             e.printStackTrace();
    //              // Handle the exception as desired (e.g., show an error message)
    //             return "error";
    //         }
    //     }
    // }

	@GetMapping("/profile")
         public String profile(@RequestParam("custUsername") String custUsername, Model model) {
           System.out.println("Customer Username : " + custUsername);
           try{
                Connection connection = dataSource.getConnection();
             String sql = "SELECT custUsername, custPhoneNo, custEmail, custName, custPass, custAddress FROM public.customer where custUsername = ?";
             final var statement = connection.prepareStatement(sql);
             statement.setString(1, custUsername);
             final var resultSet = statement.executeQuery();

            if (resultSet.next()){
                String custUsername = resultSet.getString("custUsername");
                String custPhoneNo = resultSet.getString("custPhoneNo");  
                String custEmail = resultSet.getString("custEmail"); 
                String custName = resultSet.getString("custName");
                String custPass = resultSet.getString("custPass");
                String custAddress = resultSet.getString("custAddress");

                customer customer = new customer();
                customer.setCustUsername(custUsername);
                customer.setCustPhoneNo(custPhoneNo);
                customer.setCustEmail(custEmail);
                customer.setCustName(custName);
                customer.setCustPass(custPass);
                customer.setCustAddress(custAddress);

                model.addAttribute("customer", customer);
                connection.close();
            }
           }  catch (Exception e) {
             e.printStackTrace();
           }
         
           return "profile";

    }

    // @GetMapping("/updateprofile")
    //  public String updateprofile(@RequestParam("custUsername") String custId, Model model) {
    //        System.out.println("Customer username : " + custUsername);
    //          try {
    //         Connection connection = dataSource.getConnection();
    //         String sql = "SELECT custUsername, custPhoneNo, custEmail, custName, custPass, custAddress FROM public.customer where custUsername = ?";
    //         final var statement = connection.prepareStatement(sql);
    //         statement.setString(1, custUsername);
    //         final var resultSet = statement.executeQuery();

    //         if (resultSet.next()) {
    //            String custUsername = resultSet.getString("custUsername");
    //             String custPhoneNo = resultSet.getString("custPhoneNo");  
    //             String custEmail = resultSet.getString("custEmail"); 
    //             String custName = resultSet.getString("custName");
    //             String custPass = resultSet.getString("custPass");
    //             String custAddress = resultSet.getString("custAddress");

    //             customer customer = new customer();
    //             customer.setCustUsername(custUsername);
    //             customer.setCustPhoneNo(custPhoneNo);
    //             customer.setCustEmail(custEmail);
    //             customer.setCustName(custName);
    //             customer.setCustPass(custPass);
    //             customer.setCustAddress(custAddress);

    //             model.addAttribute("customer", customer);
    //             connection.close(); 
    //         }
    //          } catch (Exception e) {
    //          e.printStackTrace();
    //        }
    //         return "updateprofile";
    //  }
    // @PostMapping("/updateprofile")
    //     public String updateprofile(@ModelAttribute("updateprofile") customer customer){
    //       System.out.println("pass here <<<<<<<");
    //     try{
    //         Connection connection = dataSource.getConnection();
    //         String sql = "UPDATE customer SET custUsername=?, custPhoneNo=?, custEmail=?, custName=?, custPass=?, custAddress=? WHERE custUsername=?";
    //         final var statement = connection.prepareStatement(sql);

    //         String custUsername = customer.getCustUsername();
    //         String custPhoneNo = customer.getCustPhoneNo();  
    //         String custEmail = customer.getCustEmail(); 
    //         String custName = customer.getCustName();
    //         String custPass = customer.getCustPass();
    //         String custAddress = customer.getCustAddress();

    //         statement.setString(1, custUsername);
	// 	    statement.setString(2, custPhoneNo);
	//         statement.setString(3, custEmail);
	// 	    statement.setString(4, custName);
	// 	    statement.setString(5, custPass);
	// 	    statement.setString(6, custAddress);

    //         statement.executeUpdate();
            
    //         connection.close();
    //     } catch(Exception e){
    //         e.printStackTrace();
    //       }
    //         return "redirect:/updateprofile";

    //     }
}
