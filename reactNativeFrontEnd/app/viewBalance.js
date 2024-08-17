import React, { useState } from 'react';
import { StyleSheet, Text, View, TextInput, TouchableOpacity, Alert } from 'react-native';
import { Link, useRouter, useLocalSearchParams } from "expo-router";

export default function viewBalance() {
  const id = useLocalSearchParams();
  const router = useRouter();
  const id2 = id.id; 

  const handleSignUp = () => {
    // Simulate API call (replace with actual fetch call)
    fetch('https://6dc7-41-222-179-235.ngrok-free.app/myprojects/jsonKikoba/Balance.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id2 }),
    })
      .then(response => response.json())
      .then(data => {
        // Handle response from server
        //Alert.alert('Success', data.message);
        if(data.status =="success"){
        Alert.alert('Hello', data.fname+" "+data.mname+" "+data.sname+"\n\n"+""+data.money);
        //assign values to vars 
        /*  const fname = data.fname;
          const mname = data.mname;
          const sname = data.sname;
          const totaContribution = data.totaContribution;
          return (
            <View>
            <Text style={styles.title}>{fname}aaaaa {mname} {sname}</Text>
            <Text style={styles.title}>{totaContribution}</Text>
          </View>
          ); 
          
        */
        }
        

      })
      .catch(error => {
        console.error('Error:', error);
        Alert.alert('Error', 'An error occurred. Please try again.');
      });
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>View total contribution</Text>
      <TouchableOpacity style={styles.button} onPress={handleSignUp}>
        <Text style={styles.buttonText}>Show balance</Text>
      </TouchableOpacity>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#f0f0f0',
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 20,
  },
  input: {
    width: '80%',
    height: 40,
    borderColor: '#ccc',
    borderWidth: 1,
    borderRadius: 8,
    marginBottom: 10,
    paddingHorizontal: 10,
  },
  button: {
    backgroundColor: '#4CAF50',
    paddingVertical: 12,
    paddingHorizontal: 60,
    borderRadius: 8,
    marginTop: 20,
  },
  buttonText: {
    color: 'white',
    fontSize: 18,
    textAlign: 'center',
  },
});
