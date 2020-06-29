import React from "react";
import Contact from "../models/Contact";
import styled from "styled-components";

type Props = {
  contact: Contact;
  onRemoveContact: (id: string) => void;
};

const Card = styled.li`
  border-radius: 20px;
  background-color: #ccc;
  padding: 16px;

  & + & {
    margin-top: 16px;
  }
`;

const ContactItem = ({ contact, onRemoveContact }: Props) => (
  <Card>
    <p>Nome: {contact.name}</p>
    <p>Email: {contact.email}</p>
    <p>Telefone: {contact.phoneNumber}</p>
    <button onClick={() => onRemoveContact(contact.id)}>Excluir Contato</button>
  </Card>
);

export default ContactItem;
