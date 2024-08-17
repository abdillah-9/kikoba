import React, { useEffect, useState } from 'react';
import { View, Text, FlatList, StyleSheet } from 'react-native';

export default function App() {
  const [data, setData] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetch( 'https://6dc7-41-222-179-235.ngrok-free.app/myprojects/jsonKikoba/viewUsersLoans.php')
      .then(response => {
        console.log('Response received:', response);
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        console.log('Data received:', data);
        setData(data);
      })
      .catch(error => {
        console.error('Fetch error:', error);
        setError(error);
      });
  }, []);

  const renderItem = ({ item }) => (
    <View style={styles.item}>
      <Text>{item.fname}</Text>
      <Text>{item.mname}</Text>
      <Text>{item.sname}</Text>
      <Text>{item.receivedLoan} Tsh</Text>
    </View>
  );

  if (error) {
    return (
      <View style={styles.container}>
        <Text style={styles.errorText}>Error: {error.message}</Text>
      </View>
    );
  }

  return (
    <View>
      <View style={styles.title}><Text style={{fontSize: 18}}>Full names:</Text><Text style={{fontSize: 18}}>Loaned amount:</Text></View>
      <FlatList
        data={data}
        renderItem={renderItem}
        keyExtractor={item => item.id.toString()}
      />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems:'stretch',
    borderColor: 'blue',
    borderWidth: 3
  },
  title: {
    display: "flex",
    flexDirection: "row",
    justifyContent: "space-between",
    padding: 10 
  },
  item: {
    padding: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#ccc',
    fontSize: 40,
    display:'flex',
    flexDirection:'row',
    justifyContent:"space-between"
  },
  errorText: {
    color: 'red',
  },
});
